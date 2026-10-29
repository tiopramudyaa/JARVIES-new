---
key: dashboard
chapter: getting-started
order: 30
title: Dashboard
summary: Baca angka ticket, tren 30 hari, dan ticket terbaru Anda sekilas.
requires: []
updated: 2026-10-29
---
`Dashboard` adalah halaman pertama setelah Anda masuk. Isinya ringkasan ticket yang boleh Anda lihat.

## Siapa yang menggunakan

Semua orang yang masuk. Angkanya mengikuti hak lihat yang sama dengan daftar ticket. Lihat [[track-tickets]].

## Sebelum Anda mulai

- Angka hanya mencakup ticket yang dapat Anda lihat. Anggota perusahaan melihat lebih sedikit ticket daripada admin perusahaan.
- Ticket internal Eclectic dan ticket yang disembunyikan tidak pernah dihitung.

## Langkah demi langkah

![Dashboard dengan kartu status, grafik 30 hari, dan ticket terbaru](images/guide/jarvies-dashboard.png)

*Tangkapan layar dengan data contoh.*

1. Baca delapan kartu di bagian atas: `Total`, `Open`, `In Process`, `Wait Customer`, `Wait 3rd Party`, `Wait Confirm`, `Hold`, dan `Closed`.
2. Baca grafik `Ticket Submissions`. Grafik ini menunjukkan berapa ticket dimulai pada tiap hari selama 30 hari terakhir.
3. Baca `Recent Tickets`. Daftar ini berisi lima ticket terbaru dengan nomor, status, dan usianya. Pilih satu untuk membukanya, atau `View all` untuk membuka daftar ticket.
4. Pakai aksi cepat di bawah: `New Ticket`, `My Tickets`, dan `My Profile`. `New Ticket` juga ada di kanan atas.

## Apa yang terjadi selanjutnya

Angkanya diperbarui setiap kali Anda membuka halaman. Membacanya tidak mengubah apa pun pada ticket Anda.

## Pertanyaan umum

**Kartu `Open` di Dashboard lebih besar daripada kartu `Open` di halaman Tickets.** Di Dashboard, `Open` menghitung semua ticket yang belum ditutup atau dibatalkan. Di halaman Tickets, `Open` hanya menghitung ticket yang statusnya persis `Open`. Lihat [[ticket-statuses]].

**Semua kartu menunjukkan nol.** Anda belum punya ticket, atau tidak ada yang boleh Anda lihat. Pilih `New Ticket` untuk mengirim yang pertama.

<!-- sources: app/Http/Controllers/DashboardController.php, resources/views/dashboard.blade.php -->
