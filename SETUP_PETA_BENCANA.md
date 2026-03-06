# 📍 Panduan Implementasi Peta Bencana Real-Time Jawa

## 🎯 Ringkasan Fitur
Sistem peta interaktif dengan data bencana real-time untuk wilayah Jawa, menampilkan:
- **Gempa Bumi** 🌍 (Merah = Sedang Terjadi)
- **Banjir** 💧 (Warna sesuai status)
- **Tanah Longsor** ⛰️ (Warna sesuai status)
- **Tsunami** 🌊 (Warna sesuai status)

## 📊 Sistem Warna Status Bencana
| Status | Warna | Arti |
|--------|-------|------|
| **Sedang Terjadi** | 🔴 Merah (#FF0000) | Bencana aktif saat ini |
| **Selesai** | ⚪ Putih (#FFFFFF) | Bencana telah berakhir |
| **Prediksi ≥50%** | 🟠 Orange (#FFA500) | Prediksi kemungkinan tinggi |
| **Prediksi <50%** | 🟡 Kuning (#FFFF00) | Prediksi kemungkinan rendah |

## 🚀 Langkah-Langkah Implementasi

### 1. **Jalankan Migrasi Database**
```bash
php artisan migrate --force
```
Perintah ini akan menambahkan field baru ke tabel `reports`:
- `latitude` (decimal 10,8)
- `longitude` (decimal 11,8)
- `prediction_percentage` (tiny integer)
- `disaster_status` (enum: Terjadi, Prediksi, Selesai)

### 2. **Seed Data Bencana Jawa**
```bash
php artisan db:seed --class=JavaDisasterSeeder
```
Ini akan menambahkan 9 data bencana contoh di wilayah Jawa dengan koordinat real:
- Surabaya (Gempa Sedang Terjadi)
- Jakarta Pusat (Banjir Sedang Terjadi)
- Bandung (Prediksi Gempa 65%)
- Sleman Yogyakarta (Longsor Sedang Terjadi)
- Semarang (Tsunami Prediksi 72%)
- Majalengka (Gempa Selesai)
- Cilacap (Banjir Prediksi 35%)
- Kediri (Gempa Sedang Terjadi)
- Puncak Bogor (Longsor Prediksi 78%)

### 3. **Verifikasi Perubahan**

#### File-File yang Telah Dimodifikasi:
1. ✅ **Migrasi Baru**: `database/migrations/2026_03_07_000000_add_coordinates_to_reports_table.php`
2. ✅ **Model Report**: `app/Models/Report.php` (field fillable & casts)
3. ✅ **ReportController**: `app/Http/Controllers/ReportController.php` 
   - Metode baru: `getDisasterData()` & `getMarkerColor()`
4. ✅ **Routes**: `routes/web.php` (endpoint `/api/disaster-data`)
5. ✅ **View Welcome**: `resources/views/welcome.blade.php` (peta Leaflet + JS real-time)
6. ✅ **Seeder Baru**: `database/seeders/JavaDisasterSeeder.php`

## 🗺️ Fitur Peta Interaktif

### Teknologi yang Digunakan:
- **Leaflet.js** - Library peta OpenSource
- **OpenStreetMap** - Tile provider maps
- **SVG Markers** - Custom marker dinamis per status
- **Fetch API** - Real-time data polling

### Cara Kerja Real-Time:
```javascript
// Update setiap 5 detik
- Fetch data dari /api/disaster-data
- Hapus marker lama
- Buat marker baru dengan warna sesuai status
- Tampilkan popup dengan detail bencana
- Stop update jika halaman tersembunyi (save bandwidth)
```

### Popup Marker Menampilkan:
- 📌 Judul Bencana
- 🏷️ Jenis Bencana
- 📍 Lokasi Lengkap
- 📅 Tanggal & Waktu
- 📝 Deskripsi Singkat
- 🎯 Status Bencana
- 📊 Persentase Prediksi (jika prediksi)

## 🌐 Endpoint API

### GET `/api/disaster-data`
Mengembalikan semua data bencana dalam format JSON:

```json
[
  {
    "id": 1,
    "title": "Gempa Bumi Magnitude 5.2 - Surabaya",
    "type": "Gempa Bumi",
    "location": "Surabaya, Jawa Timur",
    "lat": -7.2504,
    "lng": 112.7521,
    "date": "2026-03-06",
    "description": "Gempa bumi dengan magnitude 5.2...",
    "status": "Terjadi",
    "prediction": 0,
    "color": "#FF0000"
  }
]
```

## 📝 Menambah Data Bencana Baru

### Option 1: Via Database Seeder
Tambahkan ke array `$disasters` di `database/seeders/JavaDisasterSeeder.php`:
```php
[
    'title' => 'Nama Bencana',
    'disaster_type' => 'Gempa Bumi|Banjir|Tanah Longsor|Tsunami',
    'location' => 'Lokasi Lengkap',
    'latitude' => -7.xxxx,  // Koordinat (negatif untuk selatan)
    'longitude' => 110.xxxx, // Koordinat (positif untuk timur)
    'report_date' => '2026-03-06',
    'description' => 'Deskripsi detail',
    'status' => 'Diproses|Diverifikasi|Selesai',
    'disaster_status' => 'Terjadi|Prediksi|Selesai',
    'prediction_percentage' => 0, // 0-100 untuk prediksi
],
```

### Option 2: Via Form Aplikasi
- Buat laporan baru melalui menu "Laporan Cepat"
- Upload dengan koordinat GPS dari lokasi
- Admin/verifikator tambahkan latitude/longitude manual

### Option 3: Direct Database Insert
```sql
INSERT INTO reports (title, disaster_type, location, report_date, description, status, latitude, longitude, disaster_status, prediction_percentage, created_at, updated_at)
VALUES ('Bencana Baru', 'Gempa Bumi', 'Lokasi', '2026-03-06', 'Detail', 'Diproses', -7.2504, 112.7521, 'Terjadi', 0, NOW(), NOW());
```

## 🔍 Troubleshooting

### Peta Tidak Muncul
1. Pastikan `id="interactiveMap"` ada di HTML
2. Check console browser (F12) untuk error Leaflet
3. Verifikasi CDN Leaflet ter-load (lihat head tag)

### Data Tidak Update Real-Time
1. Pastikan endpoint `/api/disaster-data` accessible
2. Check network tab di browser developer tools
3. Verifikasi database memiliki data dengan latitude/longitude NULL yang valid

### Marker Tidak Muncul di Peta
1. Pastikan koordinat dalam range Jawa:
   - Latitude: -5 hingga -8
   - Longitude: 105 hingga 115
2. Check bahwa disaster_status bukan NULL

### Performance Lambat
1. Kurangi frequency update dari 5000ms (5 detik) menjadi 10000ms (10 detik)
2. Limit data hanya ke disaster yang `updated_at >= 24 jam lalu`
3. Implement pagination untuk API response

## 🔧 Kustomisasi Lebih Lanjut

### Mengubah Update Frequency
File: `resources/views/welcome.blade.php` (line ~70)
```javascript
// Update setiap 5 detik (dalam milliseconds)
updateInterval = setInterval(loadDisasterData, 5000);
// Ubah ke 10000 untuk 10 detik, 1000 untuk 1 detik, dll
```

### Menambah Jenis Bencana Baru
File: `app/Http/Controllers/ReportController.php` (metode `getMarkerColor()`)
```php
// Tambah case baru untuk disaster_type
if ($disaster->disaster_type === 'Letusan Gunung') {
    // logic warna custom
}
```

### Mengubah Tile Provider Peta
File: `resources/views/welcome.blade.php` (line ~60)
```javascript
// Ganti provider OpenStreetMap dengan Google, Mapbox, dll
L.tileLayer('https://..../').addTo(map);
```

## 📈 Statistik Monitoring

Data real-time yang ada di dashboard:
- 🔴 **Total Bencana**: Semua record
- 🟠 **Bencana Aktif**: disaster_status = 'Terjadi' atau 'Prediksi' >= 50%
- 👥 **Relawan Terdaftar**: (untuk implementasi user roles)
- 💰 **Total Donasi**: (untuk implementasi donation system)

## ✅ Checklist Verifikasi

- [ ] Migrasi berhasil berjalan
- [ ] Tabel reports memiliki field baru
- [ ] JavaDisasterSeeder berisi 9+ data bencana
- [ ] Endpoint `/api/disaster-data` return JSON
- [ ] Peta Leaflet muncul di welcome page
- [ ] Marker muncul di peta sesuai koordinat
- [ ] Popup menampilkan info lengkap saat marker diklik
- [ ] Update real-time setiap 5 detik
- [ ] Warna marker sesuai status bencana
- [ ] Legenda peta menampilkan penjelasan warna

## 📞 Support
Jika ada masalah:
1. Check console browser (F12 > Console)
2. Check network requests (F12 > Network)
3. Pastikan semua file ada & tidak error syntax
4. Review laravel logs: `storage/logs/laravel.log`

---
**Dibuat**: 2026-03-06  
**Status**: ✅ Ready untuk Deploy  
**Update Terakhir**: Real-time setiap 5 detik
