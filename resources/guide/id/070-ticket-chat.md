---
key: ticket-chat
chapter: tickets
order: 70
title: Membalas dan membagikan berkas
summary: Balas tim support, sertakan rekan lewat email, lampirkan berkas, dan ikuti meeting.
requires: []
updated: 2026-10-29
---
Kotak balasan di bagian bawah ticket adalah cara Anda berbicara dengan tim support. Semua yang Anda tulis tersimpan di ticket.

## Siapa yang menggunakan

Customer dan Super Admin.

## Sebelum Anda mulai

- Balasan dapat berisi teks, berkas, atau keduanya. Satu pesan maksimal 5.000 karakter.
- Di bawah kotak ada satu baris yang menyebut ke mana balasan Anda pergi:
  - `Replies will be sent to the support team via Email`: balasan Anda juga dikirim lewat email.
  - `Email thread active, helpdesk replies will be sent to your email`: balasan tim juga masuk ke email Anda.
  - `Replies only visible in Jarvies, no email will be sent`: ticket tidak punya jalur email.

## Langkah demi langkah

1. Buka ticket lalu klik di kotak balasan. Pakai toolbar untuk memformat teks.
2. Untuk ticket dengan jalur email, baris `CC` muncul. Ketik alamat email lalu tekan Enter untuk menambahkan. Anda dapat menempel beberapa alamat sekaligus.
3. Untuk melampirkan berkas, pilih tombol lampiran di toolbar. Maksimal 5 berkas, masing-masing 10 MB, misalnya gambar, PDF, Word, Excel, teks, CSV, ZIP, dan RAR.
4. Pilih `Send Reply`.
5. Pakai panah kecil di samping baris jalur untuk melipat kotak balasan dan membaca lebih banyak percakapan.

### Meeting

Saat tim support memulai meeting pada ticket Anda, percakapan menampilkan kartu `Meeting Started` dengan tautan `Join Meeting`. Setelah selesai, kartu `Meeting Ended` menampilkan waktu dan durasinya. Meeting dimulai oleh tim support, bukan oleh customer.

## Apa yang terjadi selanjutnya

Balasan Anda langsung muncul di percakapan. Bila ticket punya jalur email, tim juga menerimanya lewat email. Saat tim menjawab, Anda mendapat notifikasi dan daftar ticket menandai barisnya.

## Pertanyaan umum

**Sebuah lampiran ditolak.** Ukurannya lebih dari 10 MB, tipenya tidak diizinkan, atau Anda menambahkan lebih dari 5 berkas. Kirim dalam beberapa balasan.

**Baris CC tidak ada.** Ticket tidak punya jalur email, jadi balasan tetap di dalam portal.

<!-- sources: resources/views/tickets/show.blade.php, app/Http/Controllers/TicketController.php -->
