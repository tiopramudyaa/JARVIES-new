---
key: sign-in
chapter: getting-started
order: 20
title: Masuk dan password
summary: Masuk untuk pertama kali, membuat password, dan mengatur ulangnya saat lupa.
requires: []
updated: 2026-10-29
---
Anda masuk dengan alamat email dan password. Pertama kali, Anda membuat password sendiri lewat tautan yang dikirim ke email Anda.

## Siapa yang menggunakan

Setiap kontak customer dan setiap Super Admin.

## Sebelum Anda mulai

- Pakai alamat email yang terdaftar atas nama Anda di Eclectic. Bila belum terdaftar, portal menjawab `Invalid email or password.`
- Siapkan kotak masuk email Anda: masuk pertama kali membutuhkan email dari JARVIES.
- Password minimal 8 karakter.

## Langkah demi langkah

![Halaman masuk JARVIES dengan kolom email dan password](images/guide/jarvies-login.png)

*Tangkapan layar dengan data contoh.*

### Pertama kali

1. Buka portal, isi email Anda dan password apa saja dengan minimal 6 karakter. Belum perlu benar.
2. Portal menampilkan `Password Setup Required` lalu membuka `Check Your Email`.
3. Buka email itu dan pilih `Set My Password`. Tautannya berlaku 24 jam.
4. Di `Set New Password`, ketik password di `New Password` dan sekali lagi di `Confirm Password`. Halaman memeriksa panjang minimal 8 karakter dan kedua isian harus sama.
5. Kirim. Anda langsung masuk dan dibawa ke `Dashboard`.

### Setiap kali berikutnya

1. Isi email dan password Anda.
2. Masuk. Anda tiba di `Dashboard`.
3. Untuk keluar, buka menu di bawah nama Anda di kanan atas lalu pilih keluar.

### Bila Anda lupa password

1. Halaman masuk tidak memiliki tautan `Forgot password`. Tambahkan `/password/forgot` di ujung alamat portal, atau pakai `Resend password reset link` di halaman `Check Your Email`.
2. Di `Forgot Password?`, isi email terdaftar lalu pilih `Send Password Reset Link`.
3. Buka email, pilih `Reset My Password`, lalu buat password baru seperti di atas. Tautannya berlaku 24 jam.

Bila Anda sudah masuk, Anda juga dapat mengirim tautan reset ke diri sendiri dari profil. Lihat [[settings]].

## Apa yang terjadi selanjutnya

Setelah membuat password, Anda dapat masuk seperti biasa. Tautan yang lebih dari 24 jam tidak berlaku lagi, dan portal meminta Anda mengajukan yang baru.

## Pertanyaan umum

**Email tidak datang.** Periksa folder Spam atau Junk, dan pastikan alamatnya benar. Bila tetap tidak datang, hubungi tim helpdesk.

**Tautan menyatakan sudah kedaluwarsa.** Ajukan yang baru. Setiap tautan berlaku 24 jam.

**Muncul `Your account is inactive.`** Akun Anda atau akun perusahaan Anda dinonaktifkan. Hubungi tim RPMO.

**Muncul `Invalid email or password.`** Email mungkin salah atau belum terdaftar. Portal sengaja memberi pesan yang sama.

<!-- sources: app/Http/Controllers/AuthController.php, app/Http/Controllers/PasswordSetupController.php, resources/views/auth/login.blade.php, resources/views/auth/check-email.blade.php, resources/views/auth/change-password.blade.php, resources/views/auth/forgot-password.blade.php -->
