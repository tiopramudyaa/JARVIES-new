---
key: submission-history
chapter: tickets
order: 45
title: Submission History
summary: Ikuti apakah Eclectic sudah menyetujui atau menolak ticket yang Anda kirim.
requires: ["@customer"]
updated: 2026-10-29
---
`Submission History` mendaftar setiap ticket yang Anda kirim dan apakah Eclectic sudah memvalidasinya. Ticket baru mendapat nomor setelah disetujui.

## Siapa yang menggunakan

Customer.

## Sebelum Anda mulai

Anda melihat kiriman Anda sendiri. Admin perusahaan melihat kiriman seluruh perusahaan. Anggota satu grup tidak saling melihat kiriman di sini.

## Langkah demi langkah

![Submission History dengan satu kiriman menunggu, satu disetujui, dan satu ditolak](images/guide/jarvies-submission-history.png)

*Tangkapan layar dengan data contoh.*

1. Buka `Tickets`, lalu pilih `Submission History` di kanan atas.
2. Baca tiap baris: deskripsi, status, tanggal, dan prioritas.
3. Bertindaklah sesuai statusnya:
   - `Pending Validation`: Eclectic belum memeriksanya. Pilih barisnya untuk membaca apa yang Anda kirim.
   - `Approved`: ticket sudah ada. Pilih `View Ticket` untuk membukanya.
   - `Rejected`: baris menampilkan alasannya. Perbaiki hal yang ditunjuk alasan itu lalu kirim ticket baru.
4. Pilih `Back to Tickets` untuk kembali.

## Apa yang terjadi selanjutnya

Ticket yang disetujui pindah ke daftar `Tickets` dengan nomor dan statusnya sendiri. Yang ditolak tetap di sini sebagai catatan.

## Pertanyaan umum

**Muncul `No pending tickets`.** Semua kiriman Anda sudah diproses. Lihat di `Tickets`.

**Ticket saya lama berstatus `Pending Validation`.** Eclectic memvalidasi ticket secara manual. Hubungi helpdesk bila mendesak.

<!-- sources: resources/views/tickets/pending.blade.php, app/Http/Controllers/TicketController.php -->
