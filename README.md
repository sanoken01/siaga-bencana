# 🗺️ Siaga Bencana - Sistem Peta Bencana Real-Time Indonesia

> Platform monitoring dan reporting bencana Indonesia dengan peta interaktif real-time menggunakan Leaflet.js

![Laravel](https://img.shields.io/badge/Laravel-11+-red)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue)
![Database](https://img.shields.io/badge/Database-SQLite-green)
![Status](https://img.shields.io/badge/Status-Active-brightgreen)

---

## 🚀 Quick Start (Untuk Teman yang Clone)

**⚡ Jika Anda baru clone repository ini, ikuti langkah ini untuk mendapatkan DATA BENCANA:**

```bash
# 1. Install dependencies
composer install
npm install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Buat database dan isi data bencana
php artisan migrate --force
php artisan db:seed --class=JavaDisasterSeeder

# 4. Jalankan server
php artisan serve

# 5. Buka browser: http://localhost:8000
```

📖 **Baca panduan lengkap**: [DATA_SETUP.md](DATA_SETUP.md)

---

## 📋 Dokumentasi Lengkap

| Dokumen | Deskripsi |
|---------|-----------|
| [**DATA_SETUP.md**](DATA_SETUP.md) | ⭐ Setup data bencana untuk developer baru |
| [**QUICK_START_PETA_BENCANA.md**](QUICK_START_PETA_BENCANA.md) | Quick start penggunaan peta |
| [**SETUP_PETA_BENCANA.md**](SETUP_PETA_BENCANA.md) | Implementasi detail fitur peta |
| [**ARCHITECTURE.md**](ARCHITECTURE.md) | Arsitektur sistem & diagram |
| [**VERIFICATION.md**](VERIFICATION.md) | Checklist verifikasi setiap feature |
| [**IMPLEMENTATION_SUMMARY.md**](IMPLEMENTATION_SUMMARY.md) | Ringkasan implementasi |

---

## ✨ Fitur Utama

- 🗺️ **Peta Interaktif**: Real-time disaster mapping dengan Leaflet.js
- 📍 **Koordinat Real**: Lokasi akurat untuk setiap bencana di Indonesia
- 🔴 **Status Bencana**: 
  - 🔴 Sedang Terjadi (Merah)
  - 🟠 Prediksi Tinggi (Orange)
  - 🟡 Prediksi Rendah (Kuning)
  - ⚪ Selesai (Putih)
- 📊 **Data Terstruktur**: Database dengan schema jelas
- 🔄 **Real-Time Updates**: Polling setiap 5 detik
- 📱 **Responsive Design**: Mobile-friendly UI
- 🔐 **Authentication Ready**: User roles & permissions

---

## 🛠️ Technology Stack

| Layer | Technology |
|-------|-----------|
| **Backend** | Laravel 11+, PHP 8.2+ |
| **Frontend** | Blade Templates, Tailwind CSS, Vite |
| **Database** | SQLite (file-based) |
| **Maps** | Leaflet.js + OpenStreetMap |
| **Package Manager** | Composer, npm |

---

## 📊 Data Bencana

Setelah menjalankan seeder, database akan terisi dengan 9 contoh data bencana di wilayah Jawa:

```
✅ Surabaya - Gempa Bumi (Sedang Terjadi)
✅ Jakarta Pusat - Banjir (Sedang Terjadi)  
✅ Bandung - Prediksi Gempa (65%)
✅ Yogyakarta - Tanah Longsor (Sedang Terjadi)
✅ Semarang - Prediksi Tsunami (72%)
✅ Majalengka - Gempa (Selesai)
✅ Cilacap - Prediksi Banjir (35%)
✅ Kediri - Gempa (Sedang Terjadi)
✅ Puncak Bogor - Prediksi Longsor (78%)
```

---

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
