# 🚀 BisnisGrowth — Direktori Bisnis & Link-in-Bio UMKM

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)](https://vitejs.dev)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)

**BisnisGrowth** adalah platform direktori bisnis modern dan penyedia halaman *link-in-bio* yang dirancang khusus untuk membantu UMKM Indonesia melakukan digitalisasi dengan cepat dan elegan.

---

## ✨ Fitur Unggulan

- **🎨 Desain Premium:** Antarmuka mewah dengan palet warna *Burgundy* & *Gold*.
- **📱 Mobile-First:** Optimalisasi tampilan mobile dengan grid 2-kolom yang padat dan responsif.
- **📰 Portal Wawasan:** Sistem manajemen artikel edukasi bisnis dengan fitur pencarian dan filter kategori dinamis.
- **🖼️ High-End Gallery:** Detail artikel yang mendukung galeri 4 foto dengan layout profesional.
- **⚡ Performa Maksimal:** Implementasi *Server-side Caching* dan optimasi aset gambar secara otomatis.
- **🔐 Admin Central:** Panel login administrator yang aman dengan desain minimalis.
- **🚀 Elegant Preloader:** Transisi antar halaman yang halus dengan animasi logo pulsasi.
- **🔍 SEO Ready:** Metadata otomatis, Open Graph tags, dan struktur JSON-LD untuk optimasi Google.

---

## 🛠️ Tech Stack

- **Framework:** Laravel 13.x (PHP 8.3+)
- **Frontend:** Tailwind CSS 4.0 via Vite
- **Database:** MySQL 8.0
- **UI Components:** Blade Templating & Alpine.js (coming soon)
- **Analytics:** Internal Visitor & Link Click Tracking

---

## 📦 Instalasi

Ikuti langkah-langkah di bawah untuk menjalankan proyek ini secara lokal:

1. **Clone repositori:**
   ```bash
   git clone https://github.com/username/bisnisgrowth.git
   cd bisnisgrowth
   ```

2. **Instal dependensi PHP:**
   ```bash
   composer install
   ```

3. **Instal dependensi JavaScript:**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Sesuaikan pengaturan database di file `.env` Anda.*

5. **Jalankan Migrasi & Seeder:**
   ```bash
   php artisan migrate
   php artisan db:seed --class=AdminSeeder
   php artisan db:seed --class=ArticleSeeder
   ```

6. **Jalankan Aplikasi:**
   ```bash
   php artisan serve
   # Di terminal lain jalankan asset compiler
   npm run dev
   ```

---

## 🔑 Akses Default (Development)

- **Landing Page:** `http://localhost:8000`
- **Admin Login:** `http://localhost:8000/login`
- **Admin Email:** `admin@bisnisgrowth.id`
- **Admin Password:** `Admin@123!`

---

## 🛡️ Lisensi

Proyek ini berada di bawah lisensi **MIT**. Silakan gunakan dan modifikasi untuk mendukung pertumbuhan UMKM Indonesia.

---

Developed with ❤️ by **BisnisGrowth Team**
