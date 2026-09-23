<?php

namespace App\Http\Controllers\Concerns;

use Illuminate\Support\Facades\DB;

/**
 * ATURAN TUNGGAL scope & visibility tiket customer (role 3). Dipakai SEMUA
 * jalur baca yang mengembalikan tiket ke customer — TicketController
 * (getTickets(), myTickets(), getByStatus(), statistics(), dll) dan
 * DashboardController. Jangan tulis ulang aturannya di tempat lain: pernah
 * ada tiga versi berbeda hidup berdampingan sehingga daftar tiket & halaman
 * detail saling bertentangan.
 */
trait ScopesCustomerTickets
{
    /**
     * Apakah customer (role 3) yang login boleh melihat SEMUA tiket company-nya.
     * Admin = true (can_view_all_tickets), Member = false (hanya tiket sendiri).
     * Default true untuk akun lama tanpa flag.
     */
    private function customerCanViewAll(array $sessionUser): bool
    {
        if (array_key_exists('can_view_all_tickets', $sessionUser)) {
            return (bool) $sessionUser['can_view_all_tickets'];
        }

        // Fallback: baca langsung dari auth_users bila session belum membawa flag.
        $authUser = DB::table('auth_users')
            ->where('customer_id', $sessionUser['id'])
            ->where('email', $sessionUser['email'])
            ->first();

        return $authUser ? (bool) $authUser->can_view_all_tickets : true;
    }

    /**
     *   Admin (can_view_all_tickets = 1) → seluruh tiket company, tanpa filter tambahan.
     *       MENANG atas DS PIC & Contact Group: admin yang kebetulan juga terdaftar
     *       sebagai Customer PIC tetap all-access. EcoSystem sendiri melarang contact
     *       admin dijadikan PIC atau anggota grup, jadi ini menjaga kasus
     *       legacy/promosi yang terlanjur ada.
     *   DS PIC (Member yang terdaftar di delivery_support_customer_pics)
     *       → tiket DS yang ia PIC-kan, digabung (union) dengan tiket milik
     *         dirinya + sesama anggota Contact Group (bila ada).
     *   Member (+ Contact Group) → tiket yang ia submit sendiri, plus tiket yang
     *       disubmit oleh sesama anggota Contact Group-nya bila contact ini
     *       terdaftar dalam satu grup. Grup TIDAK memperluas akses staging
     *       tickets — mengikuti pola yang sama dengan DS PIC (lihat
     *       pendingPage()/getStagingTickets()).
     */
    private function applyCustomerScope($query, array $sessionUser)
    {
        if ($this->customerCanViewAll($sessionUser)) {
            return $query;
        }

        $email     = $sessionUser['email'] ?? '';
        $contactId = isset($sessionUser['contact_id']) ? (int) $sessionUser['contact_id'] : null;

        $emails = $this->getGroupMemberEmails($contactId)->push($email)->unique()->values()->all();

        if ($this->isDsPic($contactId)) {
            $dsPicTicketIds = $this->getDsPicTicketIds($contactId);

            return $query->where(function ($q) use ($dsPicTicketIds, $emails) {
                $q->whereIn('ticket_id', $dsPicTicketIds)
                  ->orWhereIn('submitted_by_email', $emails);
            });
        }

        return $query->whereIn('submitted_by_email', $emails);
    }

    /**
     * Email seluruh anggota Contact Group tempat contact ini terdaftar (termasuk
     * dirinya sendiri), dipakai untuk memperluas visibility tiket antar-Member
     * dalam satu grup. Kembalikan collection kosong jika contact tidak
     * terdaftar dalam grup manapun. Hanya anggota yang punya akun login Jarvies
     * (auth_users) yang match — anggota tanpa login tidak pernah submit tiket
     * lewat email yang bisa dikenali di sini.
     */
    private function getGroupMemberEmails(?int $contactId): \Illuminate\Support\Collection
    {
        if (!$contactId) {
            return collect();
        }

        $groupId = DB::table('customer_contact_group_members')
            ->where('contact_id', $contactId)
            ->value('group_id');

        if (!$groupId) {
            return collect();
        }

        return DB::table('customer_contact_group_members as gm')
            ->join('auth_users as au', 'au.contact_id', '=', 'gm.contact_id')
            ->where('gm.group_id', $groupId)
            ->whereNotNull('au.email')
            ->pluck('au.email');
    }

    /**
     * Terapkan filter visibility tiket untuk customer ke query Eloquent/Builder:
     * batas company (customer_id) + guard internal/hidden + aturan scope.
     * Tiket email dari domain company yang belum terdaftar sebagai contact sudah
     * ter-attribute ke customer_id company yang benar oleh EcoSystem saat intake,
     * sehingga Admin tetap melihatnya lewat filter customer_id.
     */
    private function applyCustomerTicketVisibility($query, array $sessionUser)
    {
        $query->where('customer_id', $sessionUser['id']);
        $this->applyCustomerVisibilityGuards($query);
        $this->applyCustomerScope($query, $sessionUser);

        return $query;
    }

    /**
     * Guard yang berlaku untuk SEMUA customer, tanpa memandang Admin/Member/DS PIC.
     *
     * - `ticket_type = 'Internal'` → tiket internal Eclectic. EcoSystem & JARVIES
     *   berbagi tabel `ticket` yang sama, jadi tiket internal ikut ter-scope ke
     *   customer_id company dan membingungkan customer bila tidak disaring di sini.
     *   Tiket buatan EcoSystem dengan type LAIN tetap milik customer → terlihat.
     * - `is_hidden = 1` → tiket yang disembunyikan manual lewat menu Hidden
     *   Tickets di EcoSystem.
     *
     * Keduanya di-set dari sisi EcoSystem; JARVIES hanya membaca.
     * Implementasi tunggal ada di Ticket::scopeVisibleToCustomer().
     */
    private function applyCustomerVisibilityGuards($query)
    {
        return $query->visibleToCustomer();
    }

    /**
     * Kembalikan ticket_id dari delivery support activities yang DS-nya memiliki contact ini sebagai PIC.
     * Relasi: delivery_support_customer_pics → delivery_support → delivery_support_activities → ticket_id
     * Mengembalikan Collection kosong jika contact_id null atau tidak ada DS PIC.
     */
    private function getDsPicTicketIds(?int $contactId): \Illuminate\Support\Collection
    {
        if (!$contactId) {
            return collect();
        }

        return DB::table('delivery_support_customer_pics')
            ->join('delivery_support_activities',
                'delivery_support_customer_pics.delivery_support_id',
                '=',
                'delivery_support_activities.delivery_support_id')
            ->where('delivery_support_customer_pics.contact_id', $contactId)
            ->whereNotNull('delivery_support_activities.ticket_id')
            ->pluck('delivery_support_activities.ticket_id')
            ->unique()
            ->values();
    }

    /**
     * Apakah contact ini terdaftar sebagai PIC di delivery support manapun.
     * Berbeda dari getDsPicTicketIds(): ini true begitu contact terdaftar,
     * meskipun DS-nya belum punya ticket sama sekali (dsPicTicketIds masih kosong).
     */
    private function isDsPic(?int $contactId): bool
    {
        if (!$contactId) {
            return false;
        }

        return DB::table('delivery_support_customer_pics')
            ->where('contact_id', $contactId)
            ->exists();
    }
}
