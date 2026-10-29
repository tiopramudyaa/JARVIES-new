---
key: close-ticket
chapter: tickets
order: 80
title: Menutup ticket
summary: Beri tahu tim support bahwa masalah Anda selesai dengan menutup ticket.
requires: ["@customer"]
updated: 2026-10-29
---
Menutup ticket memberi tahu Eclectic bahwa masalah Anda sudah selesai. Ini langkah terakhir setiap ticket.

## Siapa yang menggunakan

Customer.

## Sebelum Anda mulai

- Tutup ticket hanya bila masalah Anda sudah selesai. Percakapan dan berkas tetap dapat dibaca setelahnya.
- Periksa dulu deliverable bila ticket punya. Lihat [[ticket-detail]].

## Langkah demi langkah

1. Buka ticket.
2. Di panel properti, di bawah `Actions`, pilih `Close Ticket`.
3. Baca `Close This Ticket?`. Dialog menyatakan bahwa menutup ticket berarti masalah Anda sudah selesai dan email konfirmasi akan dikirim kepada Anda.
4. Pilih `Confirm`.

## Apa yang terjadi selanjutnya

Status menjadi `Closed`, satu baris tentangnya ditambahkan ke percakapan, dan Anda menerima email konfirmasi. Tombol `Close Ticket` menghilang. Folder deliverable, bila ada, tetap tersedia.

## Pertanyaan umum

**Saya tidak melihat `Close Ticket`.** Ticket sudah ditutup atau dibatalkan.

**Muncul `Ticket is already closed`.** Orang lain menutupnya sesaat sebelumnya. Muat ulang halaman.

**Saya menutupnya karena salah.** Hubungi helpdesk dan sebutkan nomor ticketnya.

<!-- sources: resources/views/tickets/show.blade.php, app/Http/Controllers/TicketController.php -->
