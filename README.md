# BisnisGrowth - Platform Direktori & Edukasi UMKM

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.4-38B2AC?style=flat-square)
![AlpineJS](https://img.shields.io/badge/AlpineJS-3.x-8BC0D0?style=flat-square)

## Deskripsi Proyek
BisnisGrowth adalah platform digital yang dirancang khusus untuk mempercepat pertumbuhan ekosistem UMKM (Usaha Mikro, Kecil, dan Menengah) di Indonesia. Website ini berfungsi sebagai jembatan antara pelaku usaha dan konsumen melalui sistem direktori bisnis yang terorganisir, sekaligus menjadi pusat wawasan strategi bisnis melalui portal edukasi editorial yang profesional.

Tujuan utama platform ini adalah memberikan kepastian legalitas, visibilitas pemasaran digital, dan panduan manajemen bagi pemilik bisnis lokal agar dapat bersaing di pasar modern.

## Fitur Utama
*   **Direktori Bisnis UMKM**: Daftar profil bisnis lokal yang dilengkapi dengan tautan interaksi langsung.
*   **Portal Wawasan Bisnis**: Sistem manajemen konten edukasi dengan optimasi SEO dan gaya editorial premium.
*   **Dashboard Analisis Konversi**: Pemantauan traffic dan interaksi pengunjung (Klik WA/Telepon) secara real-time.
*   **Manajemen Pengaturan Dinamis**: Konfigurasi identitas website dan kontak resmi melalui panel admin yang terpusat.

---

## Dokumentasi Pembaruan (13 April 2026)

### 1. Sistem Analisis Traffic & Konversi
*   **Tren Aktivitas Interaktif**: Grafik garis dengan 4 dataset (Hits Website, Klik Artikel, Klik WhatsApp, Klik Telepon).
*   **Filter Rentang Waktu**: Beralih tampilan grafik secara dinamis antara Harian (7 hari), Mingguan (8 minggu), dan Tahunan (12 bulan).
*   **Pelacakan Konversi**: Pencatatan otomatis setiap kali user mengklik tombol WhatsApp atau Telepon di artikel.
*   **Statistik Perangkat & Halaman**: Visualisasi distribusi pengunjung (Mobile vs Desktop) dan daftar halaman paling populer.

### 2. Manajemen Konten Editorial (Artikel)
*   **Sistem Multi-Gambar**: Mendukung hingga 4 gambar per artikel (1 Utama + 3 Galeri).
*   **Integrasi Kategori**: Pemilihan kategori artikel kini menggunakan dropdown dinamis yang terhubung langsung dengan Manajemen Kategori.
*   **Word Counter Real-time**: Fitur penghitung kata otomatis di formulir admin dengan indikator kelayakan konten (minimal 300 kata untuk tampilan ideal).
*   **Statistik Interaksi per Artikel**: Tabel admin kini menampilkan jumlah Klik WA, Klik Telepon, dan Total Klik Artikel untuk setiap baris data.

### 3. Perombakan UI/UX Frontend (Wawasan Bisnis)
*   **Sidebar Filter**: Navigasi kategori dan pencarian dipindahkan ke sidebar samping yang bersifat sticky.
*   **Grid 4 Kolom**: Tampilan daftar artikel dioptimalkan menjadi 4 kolom untuk memaksimalkan ruang layar.
*   **Editorial Show Page**: Implementasi efek Drop Cap, galeri 3 gambar sejajar, dan sidebar kanan sticky berisi Artikel Populer serta Rekomendasi.

### 4. Konfigurasi Sistem Dinamis
*   **Pengaturan Footer**: CRUD terpusat untuk mengelola Logo, Deskripsi Bisnis, Kontak (Email/HP/Alamat), dan Link Media Sosial.
*   **Singleton Settings**: Data footer dibagikan secara global menggunakan View Composer dan sistem Cache versi terbaru (v3).

## Teknis & Keamanan
*   **Optimasi Cache**: Validasi tipe objek (instanceof) untuk mencegah error Incomplete PHP Object.
*   **Fixed Sidebar Admin**: Navigasi panel admin terkunci (sticky) dengan area scroll mandiri.
*   **Traffic Middleware**: Pencatatan traffic global untuk akurasi data kunjungan.

---
*Dokumentasi ini dikelola sebagai bagian dari standar pengembangan BisnisGrowth.*
