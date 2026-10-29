---
key: profile
chapter: account
order: 120
title: Profil dan password Anda
summary: Baca data perusahaan Anda dan kirim tautan reset password ke diri sendiri.
requires: ["@customer"]
updated: 2026-10-29
---
`Profile` menampilkan data yang dimiliki Eclectic tentang perusahaan Anda, dan tempat meminta password baru.

## Siapa yang menggunakan

Customer.

## Sebelum Anda mulai

- Data perusahaan hanya dapat dibaca. Untuk mengoreksinya, hubungi Eclectic.
- Tautan reset dikirim ke email yang terdaftar untuk akun Anda. Bila belum ada email terdaftar, portal meminta Anda menghubungi support.

## Langkah demi langkah

![Halaman Profile dengan data perusahaan dan tab Basic Data](images/guide/jarvies-profile.png)

*Tangkapan layar dengan data contoh.*

1. Buka `Profile` dari menu di bawah nama Anda di kanan atas, atau dari `My Profile` di `Dashboard`.
2. Pakai tab untuk membaca data Anda: `Basic Data`, `Address`, `Contact Person`, `Identification`, `Bank Account`, dan `Attachment`. Di `Attachment`, Anda dapat mengunduh berkas yang disimpan untuk perusahaan Anda.
3. Untuk mengganti password, buka tab `Change Password`. Tab ini menampilkan `Registered Email` Anda.
4. Pilih `Send Password Reset Link`.
5. Buka email, pilih tombolnya, lalu buat password baru. Tautannya berlaku 24 jam. Lihat [[sign-in]].

## Apa yang terjadi selanjutnya

Password lama Anda tetap berlaku sampai Anda membuat yang baru lewat tautan itu. Setelah Anda membuatnya, Anda masuk dengan password baru.

## Pertanyaan umum

**Saya tidak dapat mengubah data saya.** Di sini data hanya dapat dibaca. Hubungi tim RPMO untuk mengubahnya.

**Muncul `No email address is associated with your account.`** Akun Anda belum punya email. Hubungi support.

**Sebuah tab kosong.** Eclectic belum memiliki data jenis itu untuk perusahaan Anda.

<!-- sources: resources/views/profile/customer/show.blade.php, app/Http/Controllers/ProfileController.php, routes/web.php -->
