---
key: create-ticket
chapter: tickets
order: 40
title: Membuat ticket
summary: Kirim permintaan support baru dengan rincian, penerima CC, dan lampiran.
requires: ["@customer"]
updated: 2026-10-29
---
Ticket adalah permintaan support. Eclectic memeriksa setiap ticket baru sebelum masuk ke antrean support.

## Siapa yang menggunakan

Customer. Bila perusahaan Anda punya end customer, kolom `Ticket For` muncul di bagian atas formulir. Pilih end customer di sana.

## Sebelum Anda mulai

- Siapkan subjek yang singkat dan jelas, serta deskripsi berisi apa yang terjadi, apa yang Anda harapkan, dan teks error bila ada.
- Kumpulkan tangkapan layar atau berkas yang ingin Anda bagikan.

## Langkah demi langkah

![Formulir New Support Ticket dengan subjek, tipe, skala, prioritas, dan rincian terisi](images/guide/jarvies-create-ticket.png)

*Tangkapan layar dengan data contoh.*

1. Pilih `New Ticket` di `Dashboard`, atau di halaman `Tickets`.
2. Ketik `Subject`. Wajib diisi, minimal 5 karakter.
3. Isi kolom opsional bila membantu: `Name` dan `No HP` kontak, `Module`, dan `Client`.
4. Pilih `Ticket Type`: `Incident`, `Service Request`, `Change Request`, atau `Consult`. Pilih `Scale`: `Simple`, `Medium`, atau `Complex`.
5. Pilih `Priority`: `Very High`, `High`, `Medium`, atau `Low`. Bawaannya `Medium`.
6. Untuk menyertakan rekan, pilih `Add CC` dan ketik tiap alamat email. Maksimal 10, dan setiap alamat harus berbeda.
7. Tulis `Details`. Wajib diisi, minimal 10 karakter. Anda dapat memformat teks dan menempel gambar langsung ke editor.
8. Untuk melampirkan berkas, pilih `Add File`. Maksimal 10 berkas, masing-masing 20 MB: gambar, PDF, Word, Excel, PowerPoint, ZIP, teks, dan CSV.
9. Pilih `Submit Ticket`.

Untuk keluar tanpa mengirim, pilih `Discard` lalu konfirmasi. Isian yang belum terkirim hilang.

## Apa yang terjadi selanjutnya

Portal menampilkan `Ticket Submitted Successfully` dan email konfirmasi dikirim ke alamat terdaftar Anda. Ticket menunggu pemeriksaan Eclectic, dan Anda dapat mengikutinya di `Submission History`. Lihat [[submission-history]]. Setelah disetujui, ticket menjadi ticket biasa dengan nomor, dan Anda membalasnya seperti di [[ticket-chat]]. Dalam beberapa kasus ticket langsung dibuat dan portal menampilkan `Ticket Created Successfully`.

## Pertanyaan umum

**Muncul `Subject Too Short` atau `Details Required`.** Subjek minimal 5 karakter dan rincian minimal 10 karakter.

**Sebuah berkas tidak ikut ditambahkan.** Ukurannya lebih dari 20 MB, atau Anda sudah mencapai 10 berkas. Perkecil atau kompres berkasnya.

**Muncul `Rate Limit Reached`.** Anda mengirim beberapa ticket dalam waktu singkat. Tunggu sebentar lalu coba lagi.

**Muncul `Email Delivery Failed`.** Ticket tersimpan tetapi email konfirmasi gagal terkirim. Hubungi support agar mereka dapat mengonfirmasinya.

<!-- sources: resources/views/tickets/create.blade.php, app/Http/Controllers/TicketController.php -->
