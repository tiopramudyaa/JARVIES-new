---
key: tickets-for-end-customers
chapter: tickets
order: 46
title: Ticket untuk end customer
summary: Kirim ticket atas nama salah satu end customer dari perusahaan Anda.
requires: ["@parent-customer"]
updated: 2026-10-29
---
Bila perusahaan Anda adalah parent customer yang punya end customer, setiap ticket harus menyebut untuk end customer yang mana.

## Siapa yang menggunakan

Akun customer dari parent customer. Bila Anda tidak melihat kolom `Ticket For`, perusahaan Anda tidak punya end customer.

## Sebelum Anda mulai

Ticket tetap berada di bawah akun Anda sendiri. Pilihan ini hanya memberi tahu Eclectic pekerjaan itu untuk end customer yang mana.

## Langkah demi langkah

1. Buka `New Ticket`. Kolom lainnya dijelaskan di [[create-ticket]].
2. Di bagian atas, kotak biru menyatakan bahwa Anda mengirim atas nama end customer.
3. Di `Ticket For`, pilih end customer dari `Select end customer`. Wajib diisi.
4. Isi sisa formulir lalu pilih `Submit Ticket`.

## Apa yang terjadi selanjutnya

Di dalam ticket, baris `For End Customer` menampilkan untuk siapa ticket itu. Ticket ada di daftar Anda sendiri.

## Pertanyaan umum

**Muncul `End Customer Required`.** Pilih end customer di `Ticket For` terlebih dahulu.

**End customer yang saya butuhkan tidak ada.** Hubungi tim RPMO untuk menambahkannya.

<!-- sources: resources/views/tickets/create.blade.php, resources/views/tickets/show.blade.php, app/Http/Controllers/AuthController.php -->
