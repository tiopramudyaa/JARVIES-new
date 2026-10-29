---
key: track-tickets
chapter: tickets
order: 50
title: Mengikuti ticket Anda
summary: Temukan ticket di daftar dengan kartu status, filter, dan pengurutan.
requires: []
updated: 2026-10-29
---
Halaman `Tickets` mendaftar semua ticket yang dapat Anda lihat. Pakai untuk menemukan ticket dan memeriksa statusnya.

## Siapa yang menggunakan

Semua orang yang masuk.

## Sebelum Anda mulai

Yang Anda lihat bergantung pada hak akses:

- **Admin perusahaan** melihat semua ticket perusahaan, dan dapat berpindah antara `My Tickets` dan `All Tickets`.
- **Anggota** melihat ticket yang ia kirim sendiri, ditambah ticket rekan di grup kontak yang sama.
- Anggota yang menjadi **PIC** sebuah delivery support juga melihat ticket support itu, dan dapat berpindah antara `My Tickets` dan `All Tickets`.

## Langkah demi langkah

![Halaman Tickets dengan kartu status dan daftar ticket](images/guide/jarvies-tickets.png)

*Tangkapan layar dengan data contoh.*

1. Buka `Tickets` dari menu.
2. Di bawah `Status Info`, kartu menghitung ticket Anda per status. Pilih sebuah kartu untuk menyaring daftar. Pilih `Total` untuk melihat semuanya.
3. Bila Anda melihat pilihan `My Tickets` dan `All Tickets`, pilih cakupan yang Anda mau.
4. Pakai judul kolom:
   - `Last Update`: pilih untuk mengurutkan menurut aktivitas terbaru.
   - `Ticket`: urutkan, atau ketik sebagian nomor ticket.
   - `Description`: ketik kata kunci.
   - `Delivery`: pilih tanggal `From` dan `To`, lalu `Apply`.
   - `Status`, `Priority`, `Type`, `Man Days`: saring menurut nilainya.
   - `Created By`: ketik nama atau email.
5. Pilih `Clear All Filters` untuk mengulang dari awal.
6. Pilih sebuah baris untuk membuka ticket. Lihat [[ticket-detail]].
7. Pakai panah halaman di bawah untuk berpindah dalam daftar. Setiap halaman menampilkan 20 ticket.

## Apa yang terjadi selanjutnya

Baris berlatar biru berarti tim support sudah membalas dan Anda belum membukanya. Membukanya menghapus tandanya.

Ticket yang Anda kirim dan belum divalidasi Eclectic juga tampil di daftar. Nomornya `(initial)` dan statusnya `Awaiting Validation`, dan nomor sebenarnya baru diberikan setelah disetujui. Lihat [[ticket-statuses]].

## Pertanyaan umum

**Ticket rekan saya tidak tampil.** Anggota melihat ticket sendiri dan ticket grup kontaknya. Tanyakan kepada admin perusahaan Anda.

**Daftar kosong.** Hapus filternya. Bila tetap kosong, Anda belum punya ticket.

**Di mana ticket yang baru saya kirim?** Ticket itu ada di `Submission History` sampai Eclectic menyetujuinya. Lihat [[troubleshooting]].

<!-- sources: resources/views/tickets/index.blade.php, app/Http/Controllers/Concerns/ScopesCustomerTickets.php -->
