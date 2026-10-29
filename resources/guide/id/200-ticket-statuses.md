---
key: ticket-statuses
chapter: reference
order: 200
title: Status, tipe, dan prioritas
summary: Arti setiap status, tipe, skala, dan prioritas ticket, serta apa yang sebaiknya Anda lakukan.
requires: []
updated: 2026-10-29
---
Setiap ticket punya status, prioritas, tipe, dan skala. Halaman ini menjelaskan tiap nilai dan apa yang sebaiknya Anda lakukan.

## Siapa yang menggunakan

Semua orang yang masuk.

## Sebelum Anda mulai

Tim support yang mengatur status. Customer memilih prioritas, tipe, dan skala saat mengirim ticket, dan dapat menutup ticket sendiri dengan `Close Ticket` di halaman ticket.

## Status

| Status | Artinya | Yang Anda lakukan |
|---|---|---|
| `Awaiting Validation` | Eclectic belum memeriksa kiriman Anda. Belum bernomor dan tampil sebagai `(initial)`. | Tunggu. Baca di `Submission History`. |
| `Open` | Ticket diterima dan menunggu dikerjakan. | Tunggu, atau tambahkan rincian dengan membalas. |
| `In Process` | Seorang konsultan sedang mengerjakannya. | Balas bila ada informasi baru. |
| `Waiting on Customer` | Tim membutuhkan sesuatu dari Anda. | Jawab pertanyaan di ticket. |
| `Waiting on 3rd Party` | Tim menunggu pihak lain, misalnya vendor. | Tunggu. |
| `Waiting Confirmation` | Tim menilai masalah sudah selesai dan meminta konfirmasi Anda. | Periksa hasilnya, lalu tutup ticket atau balas. |
| `Hold` | Pekerjaan dijeda. | Tunggu tim melanjutkan, atau tanyakan sebabnya. |
| `Closed` | Ticket selesai. | Tidak ada. |
| `Cancelled` | Ticket dibatalkan. | Kirim ticket baru bila Anda masih butuh bantuan. |

## Prioritas

`Very High`, `High`, `Medium`, dan `Low`. Bawaannya `Medium`. Pilih prioritas lebih tinggi hanya bila masalah menghalangi pekerjaan Anda, supaya tim dapat mengatur urutan kerjanya dengan baik.

## Tipe dan skala

Anda memilihnya saat membuat ticket. Keduanya opsional.

- `Incident`: sesuatu yang dulu berjalan dan sekarang tidak.
- `Service Request`: permintaan standar untuk sesuatu yang baru.
- `Change Request`: perubahan pada cara sistem Anda bekerja.
- `Consult`: pertanyaan atau saran.
- `Scale`: `Simple`, `Medium`, atau `Complex`, perkiraan Anda tentang besarnya pekerjaan.

## Apa yang terjadi selanjutnya

Status dan prioritas tampil di daftar ticket dan di halaman ticket. Pakai kartu di halaman `Tickets` untuk melihat berapa ticket di tiap status. Lihat [[track-tickets]].

## Pertanyaan umum

**Dashboard dan halaman Tickets menunjukkan angka `Open` yang berbeda.** Di Dashboard, `Open` menghitung semua yang belum ditutup atau dibatalkan. Di halaman Tickets, hanya status `Open`.

**Bisakah saya mengubah status?** Hanya untuk menutup ticket Anda sendiri. Status lainnya diatur tim.

<!-- sources: resources/views/tickets/create.blade.php, resources/views/tickets/show.blade.php, resources/views/dashboard.blade.php, resources/views/tickets/index.blade.php -->
