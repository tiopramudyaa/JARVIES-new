<?php

namespace App\Http\Controllers;

use App\Services\Guide\UserGuideService;
use Illuminate\Http\Request;

/**
 * User Guide: halaman panduan pengguna (/user-guide). Dapat dibuka SEMUA pengguna yang sudah masuk; isi disaring di SERVER
 * menurut jenis akun (topik yang tak boleh dilihat tidak pernah dikirim). JARVIES tidak punya Menu Access, jadi penyaringan
 * memakai izin semu: @customer, @customer-admin, @parent-customer, @staff.
 * Bahasa: ?lang= (sah) → bawaan (Inggris). Pilihan bahasa diingat peramban di sisi tampilan.
 */
class UserGuideController extends Controller
{
    public function __construct(private UserGuideService $guide) {}

    public function index(Request $request)
    {
        $locale = $this->guide->resolveLocale($request->query('lang'), null);
        $topics = $this->guide->topics($locale);
        $visible = $this->guide->visible($topics, [], $this->pseudoPermissions((array) session('user', [])));
        $chapters = $this->guide->chapters($visible, $locale);

        return view('user-guide.index', [
            'locale'       => $locale,
            'ui'           => config("user_guide.ui.{$locale}"),
            'locales'      => config('user_guide.locales'),
            'chapters'     => $chapters,
            'visibleCount' => count($visible),
            'totalCount'   => count($topics),
            'updated'      => $this->guide->lastUpdated($visible),
            'index'        => $this->guide->searchIndex($visible, $chapters),
        ]);
    }

    /**
     * Izin semu dari data sesi login.
     *   @customer        akun customer (role 3)
     *   @customer-admin  customer yang boleh melihat semua ticket perusahaannya (can_view_all_tickets)
     *   @parent-customer customer induk yang punya end customer
     *   @staff           Super Admin (role 1)
     *
     * @param  array<string,mixed>  $user
     * @return string[]
     */
    private function pseudoPermissions(array $user): array
    {
        $roleId = (int) ($user['role']['id'] ?? 0);
        $perms = [];

        if ($roleId === 3) {
            $perms[] = '@customer';
            if (!empty($user['can_view_all_tickets'])) {
                $perms[] = '@customer-admin';
            }
            if (!empty($user['is_parent_customer'])) {
                $perms[] = '@parent-customer';
            }
        } elseif ($roleId === 1) {
            $perms[] = '@staff';
        }

        return $perms;
    }
}
