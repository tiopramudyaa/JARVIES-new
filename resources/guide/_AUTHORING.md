# User Guide JARVIES: cara menulis topik

Berkas berawalan `_` tidak dimuat sebagai topik. Panduan dibaca dari `resources/guide/{en,id}/*.md`, satu berkas satu topik, dan ditampilkan di `/user-guide` (menu `User Guide`).

## Satu topik = sepasang berkas
- `resources/guide/en/NNN-nama.md` dan `resources/guide/id/NNN-nama.md`, dengan `key`, `chapter`, `order`, dan `requires` yang **sama**.
- Topik yang belum diterjemahkan tetap tampil dalam bahasa Inggris, tetapi test menuntut pasangan lengkap.

## Front matter
```yaml
---
key: nama-topik          # huruf kecil, angka, tanda hubung
chapter: tickets         # getting-started | tickets | account | reference (config/user_guide.php)
order: 40                # urutan di dalam bab
title: Judul topik
summary: Satu kalimat tentang isi topik.
requires: ["@customer"]  # kosong ([]) = semua pengguna; cukup salah satu izin
updated: 2026-10-29      # Y-m-d
---
```

## Izin semu (`requires`)
JARVIES tidak punya Menu Access. Topik disaring menurut jenis akun yang masuk:

| Izin | Dimiliki oleh |
|---|---|
| `@customer` | akun customer (role 3) |
| `@customer-admin` | customer yang boleh melihat semua ticket perusahaannya (`can_view_all_tickets`) |
| `@parent-customer` | customer induk yang punya end customer |
| `@staff` | Super Admin (role 1) |

Mapping-nya ada di `UserGuideController::pseudoPermissions()`. Menambah izin baru berarti mengubah controller dan daftar `PSEUDO` di `tests/Unit/Guide/UserGuideContentTest.php`.

## Isi topik
Urutan bagian: pembuka, `## Siapa yang menggunakan`, `## Sebelum Anda mulai`, `## Langkah demi langkah`, `## Apa yang terjadi selanjutnya`, `## Pertanyaan umum` (Inggris: `Who uses this`, `Before you start`, `Step by step`, `What happens next`, `Common questions`). Topik referensi boleh menambah bagian sendiri.

- Nama menu, tombol, kolom, dan pesan yang tampil di layar ditulis dengan `kode` dan **tetap berbahasa Inggris**, sama dengan layar.
- Tautan antartopik: `[[key]]` atau `[[key|teks]]`.
- **Aturan tautan mati:** sebuah topik hanya boleh menautkan topik yang terlihat oleh SEMUA orang yang dapat melihat topik asal. Contoh: topik untuk `@customer` tidak boleh menautkan topik `@parent-customer`. Test menegakkannya.
- Dilarang: HTML mentah, tautan keluar (`http:`), em dash (U+2014), dan en dash (U+2013). Pakai koma, titik dua, atau titik.
- Tulis hanya yang bisa dibuktikan dari layar atau kode. Bagian `<!-- sources: ... -->` di akhir topik menyebut berkas acuannya.

## Gambar
- Format: `![Teks alternatif](images/guide/nama.png)` lalu satu baris miring `*Tangkapan layar dengan data contoh.*`.
- Berkas di `public/images/guide/`, `png` atau `jpg`, maksimal 600 KB. Kedua bahasa memakai gambar yang sama.
- Gambar hanya boleh berisi data karangan. Jangan potret database kerja, dan jangan tampilkan email, password, token, atau data perusahaan nyata.

## Memeriksa
`php vendor/bin/phpunit tests/Unit/Guide tests/Feature/UserGuidePageTest.php`
