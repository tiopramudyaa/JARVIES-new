<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ScopesCustomerTickets;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    use ScopesCustomerTickets;

    public function index(): View
    {
        $user       = session('user');
        $customerId = (int) ($user['id'] ?? 0);

        // ── Ticket counts (real data from shared DB) ────────────────────────
        // ->visibleToCustomer(): buang tiket internal EcoSystem & tiket yang di-hide
        // (tabel `ticket` dipakai bersama EcoSystem — lihat Ticket::scopeVisibleToCustomer).
        // applyCustomerScope(): aturan yang sama dipakai halaman Tickets — Member
        // hanya lihat statistik tiketnya sendiri (+ Contact Group), DS PIC juga
        // ikut tiket DS-nya. Tanpa ini, Dashboard menghitung seluruh tiket company
        // sementara halaman Tickets membatasi ke tiket sendiri untuk role yang sama.
        $ticketQuery = Ticket::where('customer_id', $customerId)->visibleToCustomer();
        $this->applyCustomerScope($ticketQuery, $user);

        $statusCounts = $ticketQuery
            ->selectRaw("
                COUNT(*) as total,
                SUM(CASE WHEN status = 'closed' THEN 1 ELSE 0 END)                    as closed,
                SUM(CASE WHEN status = 'inprocess' THEN 1 ELSE 0 END)                 as in_process,
                SUM(CASE WHEN status = 'waiting_on_customer' THEN 1 ELSE 0 END)       as waiting_on_customer,
                SUM(CASE WHEN status = 'waiting_to_confirmation' THEN 1 ELSE 0 END)   as waiting_to_confirmation,
                SUM(CASE WHEN status = 'waiting_on_3rd_party' THEN 1 ELSE 0 END)      as waiting_on_3rd_party,
                SUM(CASE WHEN status = 'hold' THEN 1 ELSE 0 END)                      as hold,
                SUM(CASE WHEN status != 'closed' AND status != 'cancelled' THEN 1 ELSE 0 END) as open
            ")
            ->first();

        $stats = [
            'total'                   => (int) ($statusCounts->total                   ?? 0),
            'open'                    => (int) ($statusCounts->open                    ?? 0),
            'closed'                  => (int) ($statusCounts->closed                  ?? 0),
            'in_process'              => (int) ($statusCounts->in_process              ?? 0),
            'waiting_on_customer'     => (int) ($statusCounts->waiting_on_customer     ?? 0),
            'waiting_to_confirmation' => (int) ($statusCounts->waiting_to_confirmation ?? 0),
            'waiting_on_3rd_party'    => (int) ($statusCounts->waiting_on_3rd_party    ?? 0),
            'hold'                    => (int) ($statusCounts->hold                    ?? 0),
        ];

        // ── Recent tickets (last 5) ─────────────────────────────────────────
        $recentQuery = Ticket::where('customer_id', $customerId)->visibleToCustomer();
        $this->applyCustomerScope($recentQuery, $user);
        $recentTickets = $recentQuery
            ->orderByDesc('created_at')
            ->limit(5)
            ->get(['ticket_id', 'ticket_number', 'description', 'status', 'ticket_priority', 'created_at']);

        // ── Ticket trend — per day for the last 30 days, by start_date (fallback created_at) ─
        $trendQuery = DB::table('ticket')
            ->where('customer_id', $customerId)
            // Query builder mentah — scope Eloquent tidak berlaku, kondisinya ditulis ulang.
            ->where(function ($q) {
                $q->whereNull('ticket_type')
                  ->orWhere('ticket_type', '<>', Ticket::TYPE_INTERNAL);
            })
            ->whereNull('is_hidden')
            ->whereRaw('COALESCE(start_date, created_at) >= ?', [now()->subDays(29)->startOfDay()]);
        $this->applyCustomerScope($trendQuery, $user);
        $trendRows = $trendQuery
            ->selectRaw('DATE(COALESCE(start_date, created_at)) as day, COUNT(*) as cnt')
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('cnt', 'day');

        // Build complete 30-day series (fill zeros for missing days)
        $trendLabels = [];
        $trendData   = [];
        for ($i = 29; $i >= 0; $i--) {
            $date          = now()->subDays($i)->format('Y-m-d');
            $trendLabels[] = now()->subDays($i)->format('d M');
            $trendData[]   = (int) ($trendRows[$date] ?? 0);
        }

        return view('dashboard', compact('user', 'stats', 'recentTickets', 'trendLabels', 'trendData'));
    }
}
