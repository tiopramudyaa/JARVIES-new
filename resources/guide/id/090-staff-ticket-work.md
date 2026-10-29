---
key: staff-ticket-work
chapter: tickets
order: 90
title: Mengerjakan ticket sebagai Super Admin
summary: Ubah status ticket dan jalankan meeting dari portal.
requires: ["@staff"]
updated: 2026-10-29
---
Akun Super Admin melihat dua alat tambahan pada ticket: panel status dan tombol meeting.

## Siapa yang menggunakan

Hanya akun Super Admin.

## Sebelum Anda mulai

Perubahan status terlihat oleh customer dan tercatat di ticket. Pilih status yang benar, karena customer membacanya.

## Langkah demi langkah

### Mengubah status

1. Buka ticket dan lihat panel properti.
2. Di bawah `Status`, pilih satu nilai: `Open`, `In Process`, `Waiting on Customer`, `Waiting on 3rd Party`, `Waiting Confirmation`, `Hold`, `Cancelled`, atau `Closed`.
3. Pilih `Kirim` untuk menyimpan. Arti tiap nilai ada di [[ticket-statuses]].

### Menjalankan meeting

1. Di area balasan, pilih `Meeting`.
2. Di `Start Meeting?`, tempel tautan meeting bila ada. Isian ini opsional, dan tautan Zoom, Google Meet, dan Teams dikenali.
3. Pilih `Start Meeting`. Customer melihat kartu `Meeting Started` dengan tautan `Join Meeting`, dan jam SLA berhenti sementara.
4. Setelah selesai, tombolnya bertuliskan `End Meeting`. Konfirmasi dengan `End Meeting`. Customer melihat `Meeting Ended` beserta durasinya.

## Apa yang terjadi selanjutnya

Waktu meeting dicatat sebagai waiting hours dan tidak dihitung ke waktu penyelesaian SLA. Customer diberi tahu tentang perubahan status.

## Pertanyaan umum

**Saya tidak melihat tombol `Meeting`.** Tombol ini terbatas untuk akun Super Admin.

<!-- sources: resources/views/tickets/show.blade.php, app/Http/Controllers/TicketController.php -->
