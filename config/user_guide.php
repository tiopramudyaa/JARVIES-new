<?php

/**
 * User Guide JARVIES: bab (chapter) panduan pengguna. Isi panduan = berkas Markdown di resources/guide/{en,id}/*.md
 * (lihat resources/guide/_AUTHORING.md). Bab hanya mengelompokkan topik; topik yang tak boleh dilihat pengguna
 * tidak dikirim sama sekali, dan bab tanpa topik terlihat tidak tampil.
 *
 * Urutan bab = urutan di sini. `title` per bahasa; istilah menu/tombol di dalamnya tetap bahasa Inggris (sama dengan layar aplikasi).
 */
return [
    'locales' => ['en' => 'English', 'id' => 'Bahasa Indonesia'],
    'default_locale' => 'en',

    'chapters' => [
        'getting-started' => ['icon' => 'compass',  'title' => ['en' => 'Getting started',        'id' => 'Memulai']],
        'tickets'         => ['icon' => 'ticket',   'title' => ['en' => 'Tickets',                'id' => 'Ticket']],
        'account'         => ['icon' => 'user',     'title' => ['en' => 'Account & settings',     'id' => 'Akun & pengaturan']],
        'reference'       => ['icon' => 'book',     'title' => ['en' => 'Help & reference',       'id' => 'Bantuan & referensi']],
    ],

    // Teks tetap pada tampilan (bukan isi panduan).
    'ui' => [
        'en' => [
            'title' => 'User Guide', 'subtitle' => 'Step-by-step help for using the JARVIES portal.',
            'toc' => 'Table of Contents', 'toc_hint' => 'Search, or pick a chapter and topic to jump straight to it.', 'expand_all' => 'Expand all', 'collapse_all' => 'Collapse all', 'chapter' => 'Chapter', 'topic_count' => 'topics', 'search_toc' => 'Search the guide…', 'no_results' => 'Nothing found. Try another word.',
            'results' => 'results', 'updated' => 'Updated', 'language' => 'Language', 'tailored' => 'This guide is tailored to your account',
            'topics_of' => 'topics', 'on_this_page' => 'On this topic', 'back_top' => 'Back to top',
            'untranslated' => 'This topic is not available in your language yet; the English version is shown.', 'related' => 'Related topics', 'empty' => 'No topics are available for your account yet.',
            'note' => 'Note', 'tip' => 'Tip', 'important' => 'Important', 'warning' => 'Warning', 'topic_updated' => 'Topic updated',
        ],
        'id' => [
            'title' => 'User Guide', 'subtitle' => 'Panduan langkah demi langkah untuk memakai portal JARVIES.',
            'toc' => 'Daftar Isi', 'toc_hint' => 'Cari, atau pilih bab dan topik untuk langsung menuju ke sana.', 'expand_all' => 'Buka semua', 'collapse_all' => 'Tutup semua', 'chapter' => 'Bab', 'topic_count' => 'topik', 'search_toc' => 'Cari di panduan…', 'no_results' => 'Tidak ditemukan. Coba kata lain.',
            'results' => 'hasil', 'updated' => 'Diperbarui', 'language' => 'Bahasa', 'tailored' => 'Panduan ini disesuaikan dengan akun Anda',
            'topics_of' => 'topik', 'on_this_page' => 'Di topik ini', 'back_top' => 'Kembali ke atas',
            'untranslated' => 'Topik ini belum tersedia dalam bahasa Anda; versi bahasa Inggris ditampilkan.', 'related' => 'Topik terkait', 'empty' => 'Belum ada topik yang tersedia untuk akun Anda.',
            'note' => 'Catatan', 'tip' => 'Tips', 'important' => 'Penting', 'warning' => 'Peringatan', 'topic_updated' => 'Topik diperbarui',
        ],
    ],
];
