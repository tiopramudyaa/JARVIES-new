<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * AttachmentController
 *
 * Proxy route untuk mengambil attachment dari Microsoft Graph on-demand.
 * File tidak pernah disimpan lokal — metadata (graph_message_id, graph_attachment_id)
 * disimpan di ticket_attachment oleh EcoSystem processInbox/sendTicketReply.
 *
 * Route: GET /attachments/{id}  (middleware: jarvies.auth)
 */
class AttachmentController extends Controller
{
    public function show($id)
    {
        $sessionUser = session('user');
        if (!$sessionUser) {
            abort(401, 'Unauthorized');
        }

        $attachment = TicketAttachment::findOrFail($id);

        // Customer hanya bisa akses attachment dari tiket miliknya
        if (($sessionUser['role']['id'] ?? 0) == 3) {
            $ticket = Ticket::find($attachment->ticket_id);
            // isVisibleToCustomer(): tiket internal EcoSystem & tiket yang di-hide
            // tertutup untuk customer (lihat Ticket::scopeVisibleToCustomer).
            if (!$ticket || $ticket->customer_id != $sessionUser['id'] || !$ticket->isVisibleToCustomer()) {
                abort(403, 'Forbidden');
            }
        }

        // Jika ada graph_message_id + graph_attachment_id → fetch dari Graph
        if ($attachment->graph_message_id && $attachment->graph_attachment_id) {
            return $this->fetchFromGraph($attachment);
        }

        // Fallback: file lokal lama — serve langsung agar Content-Disposition terpasang (nama asli, bukan UUID)
        if ($attachment->file_path) {
            if (!Storage::disk('public')->exists($attachment->file_path)) {
                abort(404, 'File not found');
            }
            $fileName    = $attachment->file_name ?? basename($attachment->file_path);
            $mime        = $attachment->mime_type ?? 'application/octet-stream';
            $isInline    = $attachment->is_inline ?? false;
            $disposition = $isInline ? 'inline' : 'attachment';
            $asciiName   = str_replace(['"', '\\', "\r", "\n"], '', preg_replace('/[^\x20-\x7E]/', '_', $fileName));

            return response()->file(Storage::disk('public')->path($attachment->file_path), [
                'Content-Type'        => $mime,
                'Content-Disposition' => $disposition . '; filename="' . $asciiName . '"; filename*=UTF-8\'\'' . rawurlencode($fileName),
                'Cache-Control'       => 'private, max-age=3600',
            ]);
        }

        // Fallback: link langsung
        if ($attachment->link_url) {
            return redirect($attachment->link_url);
        }

        // Baris tanpa Graph ID (mis. lookup Sent Items gagal saat balasan dikirim):
        // coba pulihkan lewat email_message_id sebelum menyerah.
        if ($this->recoverGraphIds($attachment)) {
            return $this->fetchFromGraph($attachment);
        }

        abort(404, 'Attachment not found');
    }

    /**
     * Kredensial + app token Graph (client_credentials). Abort jika tidak tersedia.
     *
     * @return array{0:string,1:string,2:string} [accessToken, baseUrl, sender]
     */
    private function graphContext(): array
    {
        $tenantId     = config('services.microsoft_graph.tenant_id');
        $clientId     = config('services.microsoft_graph.client_id');
        $clientSecret = config('services.microsoft_graph.client_secret');
        $sender       = config('services.microsoft_graph.sender_email');

        if (!$tenantId || !$clientId || !$clientSecret || !$sender) {
            Log::error('AttachmentController: MS credentials not configured');
            abort(503, 'Attachment service not configured');
        }

        // Ambil app access token via client_credentials
        $tokenRes = Http::asForm()->post(
            "https://login.microsoftonline.com/{$tenantId}/oauth2/v2.0/token",
            [
                'grant_type'    => 'client_credentials',
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'scope'         => 'https://graph.microsoft.com/.default',
            ]
        );

        if (!$tokenRes->successful()) {
            Log::error('AttachmentController: failed to get app token', [
                'status' => $tokenRes->status(),
            ]);
            abort(502, 'Failed to authenticate with Microsoft');
        }

        return [
            $tokenRes->json('access_token'),
            rtrim(config('services.microsoft_graph.base_url', 'https://graph.microsoft.com/v1.0'), '/'),
            $sender,
        ];
    }

    /**
     * Cari ulang ID pesan + ID attachment yang valid di mailbox Graph dan simpan ke DB.
     *
     * Kuncinya internetMessageId di ticket_message.email_message_id; attachment
     * dicocokkan berdasarkan nama file. Dipakai saat ID kosong atau sudah tidak
     * valid (draft ID berubah setelah email terkirim).
     *
     * @return bool true jika ID berhasil ditemukan dan disimpan
     */
    private function recoverGraphIds(TicketAttachment $attachment): bool
    {
        if (!$attachment->message_id) {
            return false;
        }

        $internetMsgId = DB::table('ticket_message')
            ->where('id', $attachment->message_id)
            ->value('email_message_id');

        if (!$internetMsgId) {
            return false;
        }

        try {
            [$accessToken, $baseUrl, $sender] = $this->graphContext();

            // 1) Filter langsung di seluruh mailbox (mencakup email yang dipindah folder).
            $filtered = Http::withToken($accessToken)->get("{$baseUrl}/users/{$sender}/messages", [
                '$filter' => "internetMessageId eq '" . str_replace("'", "''", $internetMsgId) . "'",
                '$select' => 'id',
                '$top'    => 1,
            ]);
            $msgId = $filtered->successful() ? ($filtered->json('value.0.id') ?? null) : null;

            // 2) Fallback: pindai Sent Items terbaru dan cocokkan di PHP.
            if (!$msgId) {
                $scan = Http::withToken($accessToken)->get("{$baseUrl}/users/{$sender}/mailFolders/SentItems/messages", [
                    '$orderby' => 'sentDateTime desc',
                    '$select'  => 'id,internetMessageId',
                    '$top'     => 50,
                ]);
                foreach ($scan->json('value') ?? [] as $msg) {
                    if (($msg['internetMessageId'] ?? '') === $internetMsgId) {
                        $msgId = $msg['id'];
                        break;
                    }
                }
            }

            if (!$msgId) {
                Log::warning('AttachmentController: recoverGraphIds: pesan tidak ditemukan', [
                    'id'               => $attachment->id,
                    'email_message_id' => $internetMsgId,
                ]);
                return false;
            }

            $attList = Http::withToken($accessToken)->get(
                "{$baseUrl}/users/{$sender}/messages/{$msgId}/attachments",
                ['$select' => 'id,name']
            );
            $attId = null;
            foreach ($attList->json('value') ?? [] as $sa) {
                if (strtolower($sa['name'] ?? '') === strtolower($attachment->file_name ?? '')) {
                    $attId = $sa['id'];
                    break;
                }
            }

            if (!$attId) {
                Log::warning('AttachmentController: recoverGraphIds: attachment tidak cocok by nama', [
                    'id'        => $attachment->id,
                    'file_name' => $attachment->file_name,
                ]);
                return false;
            }

            $attachment->update([
                'graph_message_id'    => $msgId,
                'graph_attachment_id' => $attId,
            ]);

            Log::info('AttachmentController: Graph ID dipulihkan', ['id' => $attachment->id]);

            return true;
        } catch (\Throwable $e) {
            // abort() dari graphContext() adalah HttpException; biarkan lewat.
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                throw $e;
            }
            Log::warning('AttachmentController: recoverGraphIds gagal', [
                'id'    => $attachment->id,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Fetch file dari Microsoft Graph menggunakan app credentials (client_credentials),
     * lalu stream ke browser.
     */
    private function fetchFromGraph(TicketAttachment $attachment)
    {
        [$accessToken, $baseUrl, $sender] = $this->graphContext();

        $res = Http::withToken($accessToken)
            ->get("{$baseUrl}/users/{$sender}/messages/{$attachment->graph_message_id}/attachments/{$attachment->graph_attachment_id}");

        // 404: ID kemungkinan draft ID lama yang tidak valid setelah email terkirim.
        if ($res->status() === 404 && $this->recoverGraphIds($attachment)) {
            $res = Http::withToken($accessToken)
                ->get("{$baseUrl}/users/{$sender}/messages/{$attachment->graph_message_id}/attachments/{$attachment->graph_attachment_id}");
        }

        if (!$res->successful()) {
            Log::error('AttachmentController: attachment fetch failed', [
                'id'     => $attachment->id,
                'status' => $res->status(),
                'body'   => $res->body(),
            ]);
            abort(404, 'Attachment not found in Microsoft');
        }

        $data         = $res->json();
        $contentBytes = base64_decode($data['contentBytes'] ?? '');
        $contentType  = $data['contentType'] ?? ($attachment->mime_type ?? 'application/octet-stream');
        $fileName     = $data['name'] ?? ($attachment->file_name ?? 'attachment');
        $isInline     = $attachment->is_inline ?? false;
        $disposition  = $isInline ? 'inline' : 'attachment';
        $asciiName    = str_replace(['"', '\\', "\r", "\n"], '', preg_replace('/[^\x20-\x7E]/', '_', $fileName));

        return response($contentBytes, 200)
            ->header('Content-Type', $contentType)
            ->header('Content-Disposition', $disposition . '; filename="' . $asciiName . '"; filename*=UTF-8\'\'' . rawurlencode($fileName))
            ->header('Cache-Control', 'private, max-age=3600')
            ->header('Content-Length', strlen($contentBytes));
    }
}
