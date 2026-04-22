# BisnisGrowth - Akselerator Pertumbuhan UMKM Digital Indonesia

![Laravel](https://img.shields.io/badge/Framework-Laravel_13-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/Language-PHP_8.3+-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=for-the-badge&logo=mysql)
![TailwindCSS](https://img.shields.io/badge/Styling-Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css)
![AlpineJS](https://img.shields.io/badge/Interactive-Alpine_JS-8BC0D0?style=for-the-badge&logo=alpine.js)

## 1. Visi dan Filosofi Proyek
**BisnisGrowth** adalah platform ekosistem digital yang dirancang khusus untuk memodernisasi cara UMKM (Usaha Mikro, Kecil, dan Menengah) di Indonesia berinteraksi dengan pasar digital. Platform ini hadir sebagai **Akselerator Pertumbuhan** yang menggabungkan direktori bisnis terorganisir dengan portal edukasi strategi bisnis yang dikelola secara profesional.

## 2. Pilar Utama Sistem

### A. Portal Wawasan Bisnis & Editorial Premium
Website ini mengimplementasikan standar majalah bisnis dengan optimasi visual:
*   **Modern UI/UX**: Estetika bersih dengan *border-radius* yang rapi dan tipografi Inter yang tajam.
*   **Multi-Visual Gallery**: Mendukung hingga 4 aset gambar per artikel untuk konteks visual yang kaya.
*   **Spintax Engine**: Sistem variasi judul dan konten otomatis (`{A|B}`) untuk meningkatkan keunikan konten dan performa SEO tanpa duplikasi.

### B. Optimasi Gambar & Media (CPanel Ready)
Sistem manajemen aset yang dirancang khusus untuk performa tinggi dan kemudahan *deployment*:
*   **WebP Conversion**: Otomatis mengonversi setiap unggahan gambar ke format `.webp` untuk ukuran file yang jauh lebih ringan.
*   **Auto Resize**: Menyesuaikan dimensi gambar secara otomatis (max 1200px) untuk menjaga performa loading.
*   **Public Storage Architecture**: Penyimpanan aset langsung ke folder `public/uploads` untuk menghindari kendala *symbolic link* pada *shared hosting* (cPanel).
*   **Lazy Loading**: Implementasi pemuatan gambar secara tertunda untuk menghemat bandwidth dan mempercepat akses halaman.

### C. Advanced Traffic & Conversion Analytics
Berfokus pada **Data Konversi** untuk memantau pertumbuhan bisnis:
*   **Click Event Tracking**: Melacak interaksi riil pengguna (Klik WhatsApp, Telepon, dan Hits Artikel).
*   **Trend Visualization**: Grafik performa interaktif untuk memantau aktivitas Harian, Mingguan, dan Bulanan.
*   **Security Protection**: Folder unggahan dilindungi dengan konfigurasi khusus untuk mencegah eksekusi skrip berbahaya.

### D. Konfigurasi Sistem Terpusat
Memudahkan manajemen identitas website melalui satu pintu:
*   **Site Identity Control**: Mengatur branding global, SEO metadata, dan integrasi Google Analytics.
*   **Footer & Social Management**: Sinkronisasi informasi kontak dan media sosial di seluruh elemen website secara instan.

## 3. Standar Teknis & SEO
*   **URL Friendly**: Struktur rute berbasis *slug* yang bersih.
*   **Schema Markup (JSON-LD)**: Implementasi otomatis skema data terstruktur untuk hasil pencarian Google yang lebih kaya.
*   **Sitemap & Robots Control**: File `sitemap.xml` dinamis untuk memandu bot indeksasi.
*   **Cache Management**: Sistem pembersihan cache cerdas yang hanya menghapus data spesifik saat terjadi perubahan konten.

## 4. Keamanan
*   **Deny Script Execution**: Proteksi folder `uploads` menggunakan `.htaccess` untuk memblokir akses file PHP ilegal.
*   **Role-Based Access Control**: Pemisahan hak akses yang ketat antara Administrator dan User.

---
Dokumentasi ini mencerminkan dedikasi kami dalam membangun infrastruktur digital yang tangguh bagi masa depan UMKM Indonesia.
