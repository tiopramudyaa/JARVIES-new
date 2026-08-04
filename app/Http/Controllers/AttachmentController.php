<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketAttachment;
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

        abort(404, 'Attachment not found');
    }

    /**
     * Fetch file dari Microsoft Graph menggunakan app credentials (client_credentials),
     * lalu stream ke browser.
     */
    private function fetchFromGraph(TicketAttachment $attachment)
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

        $accessToken = $tokenRes->json('access_token');
        $baseUrl     = rtrim(config('services.microsoft_graph.base_url', 'https://graph.microsoft.com/v1.0'), '/');

        $res = Http::withToken($accessToken)
            ->get("{$baseUrl}/users/{$sender}/messages/{$attachment->graph_message_id}/attachments/{$attachment->graph_attachment_id}");

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
