---
key: ticket-detail
chapter: tickets
order: 60
title: Membaca ticket
summary: Pahami percakapan, panel properti, dan folder deliverable pada sebuah ticket.
requires: []
updated: 2026-10-29
---
Halaman ticket memiliki percakapan di sebelah kiri dan properti di sebelah kanan. Buka dengan memilih ticket di daftar, di `Recent Tickets`, atau di notifikasi.

## Siapa yang menggunakan

Semua orang yang masuk.

## Sebelum Anda mulai

Anda hanya dapat membuka ticket yang boleh Anda lihat. Lihat [[track-tickets]].

## Langkah demi langkah

![Halaman ticket dengan daftar ticket di kiri, percakapan di tengah, dan panel properti di kanan](images/guide/jarvies-ticket-detail.png)

*Tangkapan layar dengan data contoh.*

1. Di sebelah kiri, di bawah `Back to Tickets`, daftar ticket Anda tetap terlihat. Pakai `Search tickets…` untuk mencari, dan pilih ticket lain untuk berpindah tanpa kembali ke daftar. Pilih `Back to Tickets` untuk kembali ke daftar lengkap.
2. Baca bagian atas: subjek, nomor ticket, tipe ticket, serta siapa pembuatnya dengan tanggalnya. Waktu dalam WIB.
3. Baca percakapan di tengah. Isinya pesan Anda, balasan tim support, dan baris sistem seperti perubahan status. Kartu meeting juga muncul di sini. Lihat [[ticket-chat]].
4. Buka panel properti dengan tombol di kanan atas bagian judul. Isinya:
   - `Status`, `Priority`, dan `Ticket Type`. Lihat [[ticket-statuses]].
   - `Man Days`: jumlah hari kerja yang disetujui, atau tanda hubung bila belum ada yang disetujui.
   - `Customer`, dan `For End Customer` bila ticket untuk end customer.
   - `Start Date`, `Due Date`, `Created`, dan `Created By`.
5. Bila ada deliverable, `Open Deliverable Folder` muncul di bawah `Deliverable`. Tautan ini membuka folder ticket ini saja, dan tetap tersedia setelah ticket ditutup.

## Apa yang terjadi selanjutnya

Bila status berubah atau tim membalas, Anda mendapat notifikasi. Lihat [[notifications]].

## Pertanyaan umum

**Man Days menunjukkan tanda hubung.** Belum ada effort yang disetujui untuk ticket itu.

**Saya tidak dapat mengubah status.** Bagi customer, status hanya dapat dibaca. Anda dapat menutup ticket sendiri dengan `Close Ticket` di panel properti. Status lainnya diatur tim support.

**Saya tidak melihat `Open Deliverable Folder`.** Belum ada deliverable yang diunggah.

<!-- sources: resources/views/tickets/show.blade.php -->
