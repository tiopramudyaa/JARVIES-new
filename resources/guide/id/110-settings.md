---
key: settings
chapter: account
order: 110
title: Settings
summary: Ubah tema, warna aksen, ukuran teks, notifikasi, dan lihat cara mengganti password.
requires: []
updated: 2026-10-29
---
`Settings` mengubah tampilan dan perilaku portal untuk Anda. Tidak ada yang berubah bagi orang lain.

## Siapa yang menggunakan

Semua orang yang masuk.

## Sebelum Anda mulai

Pilihan Anda disimpan ke akun, jadi ikut Anda ke peramban atau perangkat lain setelah masuk. Bila portal tidak dapat menjangkau server, pilihan disimpan di peramban ini saja dan portal menyebutkannya.

## Langkah demi langkah

![Halaman Settings pada tab Appearance dengan tema dan warna aksen](images/guide/jarvies-settings.png)

*Tangkapan layar dengan data contoh.*

1. Buka `Settings` dari menu. Halaman memiliki empat tab.
2. `Appearance`: pilih `Theme Mode` (`Light`, `Dark`, atau `System` yang mengikuti perangkat) dan `Accent Color` yang dipakai untuk tombol, tautan, dan sorotan. Pilih salah satu dari enam warna siap pakai, atau tentukan sendiri lewat `Custom color`.
3. `Preferences`: pilih `Font Size` (`Small`, `Medium`, atau `Large`), nyalakan `Compact Mode` untuk tata letak lebih padat, dan nyalakan atau matikan `Show Animations`.
4. `Notifications`: nyalakan atau matikan `Enable Notifications`, pilih `Notification Sound`, atau pilih `Clear All` untuk menghapus riwayat. Lihat [[notifications]].
5. `Security`: menampilkan `Password Reset`. Untuk mengganti password, pakai `Send Password Reset Link` di profil Anda. Tab yang sama menampilkan `Account`, `Role`, dan `Customer Code` di bawah `Current Session`.
6. Pilih `Save Changes` untuk menyimpan pilihan. `Reset to Default` mengembalikan semuanya ke nilai awal setelah Anda konfirmasi.

## Apa yang terjadi selanjutnya

Halaman langsung menerapkan pilihan Anda dan menampilkan `Settings saved successfully!` setelah disimpan. Settings bersifat pribadi dan tidak mengubah ticket Anda.

## Pertanyaan umum

**Muncul `Settings saved locally only.`** Server tidak dapat dijangkau. Pilihan Anda berlaku di peramban ini. Simpan lagi saat koneksi kembali.

**Di mana saya mengganti password?** Lihat [[sign-in]].

<!-- sources: resources/views/settings/index.blade.php, app/Http/Controllers/SettingsController.php -->
