# 🚀 Quick Start Guide - Peta Bencana Real-Time

## Di Mana Peta Itu Berada?
- **URL**: `http://localhost:8000` (homepage)
- **Bagian**: Section "Peta Bencana Jawa Timur" di tengah halaman
- **Identifier**: Lihat ID section `\<section id="peta"\>`

---

## ⚡ Setup Cepat (3 Langkah)

### 1️⃣ Jalankan Migrasi
```bash
php artisan migrate --force
```
✅ Ini menambahkan kolom: latitude, longitude, prediction_percentage, disaster_status

### 2️⃣ Seed Data Bencana
```bash
php artisan db:seed --class=JavaDisasterSeeder
```
✅ Ini menambah 9 contoh bencana di berbagai lokasi Jawa

### 3️⃣ Buka Browser
```
http://localhost:8000
```
✅ Scroll ke section peta, klik marker untuk detail

---

## 📍 Koordinat Lokasi Jawa dalam Database

| No | Kota/Wilayah | Latitude | Longitude | Disaster Type | Status |
|----|----------------|----------|-----------|---|---|
| 1 | Surabaya | -7.2504 | 112.7521 | Gempa Bumi | 🔴 Terjadi |
| 2 | Jakarta Pusat | -6.1751 | 106.8249 | Banjir | 🔴 Terjadi |
| 3 | Bandung | -6.9175 | 107.6015 | Gempa (65%) | 🟠 Prediksi |
| 4 | Sleman, Yogya | -7.4467 | 110.4402 | Longsor | 🔴 Terjadi |
| 5 | Semarang | -6.9665 | 110.4038 | Tsunami (72%) | 🟠 Prediksi |
| 6 | Majalengka | -6.8976 | 108.2146 | Gempa (Done) | ⚪ Selesai |
| 7 | Cilacap | -7.7264 | 109.0265 | Banjir (35%) | 🟡 Prediksi |
| 8 | Kediri | -7.2498 | 111.8689 | Gempa | 🔴 Terjadi |
| 9 | Puncak Bogor | -6.7426 | 106.9896 | Longsor (78%) | 🟠 Prediksi |

---

## 🎨 Warna Marker + Makna

| Warna | Hex Code | Makna | Contoh |
|-------|----------|-------|--------|
| 🔴 Merah | #FF0000 | **SEDANG TERJADI** | Gempa, banjir sekarang |
| ⚪ Putih | #FFFFFF | **SELESAI** | Bencana kemarin sudah ditangani |
| 🟠 Orange | #FFA500 | **PREDIKSI TINGGI** | Prediksi ≥ 50% kemungkinan |
| 🟡 Kuning | #FFFF00 | **PREDIKSI RENDAH** | Prediksi < 50% kemungkinan |

---

## 📡 Real-Time Updates

### Bagaimana Caranya?
```javascript
// Setiap 5 detik, peta melakukan:
1. Fetch ke /api/disaster-data
2. Hapus marker lama
3. Buat marker baru
4. Tampilkan popup
```

### Bisa Diubah?
Ya! Di file `resources/views/welcome.blade.php`, cari:
```javascript
updateInterval = setInterval(loadDisasterData, 5000);
// 5000 = 5 detik
// Ubah ke 10000 untuk 10 detik, 1000 untuk 1 detik, dll
```

---

## 🔍 Apa Isi Popup Saat Klik Marker?

```
┌─────────────────────────────────┐
│ Gempa Bumi Magnitude 5.2 - Surabaya
├─────────────────────────────────┤
│ Tipe: Gempa Bumi                │
│ Lokasi: Surabaya, Jawa Timur    │
│ Tanggal: 2026-03-06 14:30       │
│ Deskripsi: Gempa bumi dengan... │
│                                 │
│ [Gempa Bumi] [SEDANG TERJADI]  │
└─────────────────────────────────┘
```

---

## ➕ Cara Tambah Bencana Baru

### Method 1: Database Seed (Recommended)
Edit file `database/seeders/JavaDisasterSeeder.php`:
```php
[
    'title' => 'Tsunami Warning - Cilacap',
    'disaster_type' => 'Tsunami',
    'location' => 'Cilacap, Jawa Tengah',
    'latitude' => -7.7264,
    'longitude' => 109.0265,
    'report_date' => '2026-03-06',
    'description' => 'Potensi tsunami di selatan Cilacap...',
    'status' => 'Diproses',
    'disaster_status' => 'Prediksi',
    'prediction_percentage' => 55,
],
```

Kemudian jalankan:
```bash
php artisan db:seed --class=JavaDisasterSeeder
```

### Method 2: Via Admin Form
- Buka menu "Laporan Cepat"
- Isi form dengan detail lokasi
- Upload foto & koordinat GPS
- Admin verifikasi & tambah lat/long manual

### Method 3: Direct SQL Insert
```sql
INSERT INTO reports 
(title, disaster_type, location, report_date, description, status, latitude, longitude, disaster_status, prediction_percentage, created_at, updated_at)
VALUES 
('Longsor Kabupaten X', 'Tanah Longsor', 'Kab X, Jawa', '2026-03-06', 'Longsor terjadi di...', 'Diproses', -7.5000, 109.5000, 'Terjadi', 0, NOW(), NOW());
```

---

## 🧪 Testing

### Check Endpoint API
Buka di browser:
```
http://localhost:8000/api/disaster-data
```

Harus menampilkan JSON seperti:
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

### Debug di Browser (F12)
1. Buka Developer Tools (F12)
2. Tab **Console** - lihat fetch requests
3. Tab **Network** - lihat response `/api/disaster-data`
4. Tab **Elements** - cek struktur HTML peta

---

## ⚙️ Konfigurasi Lanjutan

### Mengubah Area Peta Default
Di `resources/views/welcome.blade.php` cari `setView`:
```javascript
// Koordinat Jawa: -7.0726, 110.3927
map = L.map('interactiveMap').setView([-7.0726, 110.3927], 8);
// [-lat, lng], zoom_level
```

### Mengubah Tile Provider
Ganti OpenStreetMap dengan Mapbox, Google, dll:
```javascript
// OpenStreetMap (default)
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Atau Mapbox (ganti YOUR_TOKEN):
L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/static/...', {
    accessToken: 'YOUR_TOKEN'
}).addTo(map);
```

---

## 🐛 Troubleshooting

### ❌ Peta Tidak Muncul
**Solusi:**
- Buka DevTools (F12) > Console
- Lihat ada error Leaflet tidak ter-load?
- CDN Leaflet mungkin down, coba refresh

### ❌ Marker Tidak Muncul
**Solusi:**
- Pastikan data di database memiliki latitude & longitude
- Check console untuk error JavaScript
- Verifikasi koordinat dalam range: -8°S to -5°S, 105°E to 115°E

### ❌ Update Tidak Real-Time
**Solusi:**
- Cek Network tab, apakah `/api/disaster-data` di-hit setiap 5 detik?
- Cek console untuk fetch errors
- Database mungkin tidak update, cek tabel reports

### ❌ Popup Tidak Muncul
**Solusi:**
- JavaScript mungkin ter-load terlambat
- Coba hard-refresh (Ctrl+Shift+R atau Cmd+Shift+R)
- Verifikasi `createPopupContent()` function ada

---

## 📊 Performance Tips

### Untuk Area dengan Banyak Marker (>1000):
1. **Marker Clustering** - Grup marker saat zoom out
2. **Limit Data** - Return hanya 100 marker terakhir di API
3. **Slower Update** - Ubah 5 detik menjadi 30 detik
4. **Pagination** - Muat data halaman per halaman

### Implementasi Marker Clustering:
```javascript
// Tambah library: Leaflet.markercluster
// Gunakan: L.markerClusterGroup() untuk group markers
```

---

## 📞 File-File Penting

| File | Fungsi | Line |
|------|--------|------|
| `app/Http/Controllers/ReportController.php` | API endpoint `getDisasterData()` | Line 67-90 |
| `database/migrations/2026_03_07_...` | Tambah field lat/lng | Line 1-30 |
| `database/seeders/JavaDisasterSeeder.php` | Data contoh bencana | Line 1-100 |
| `resources/views/welcome.blade.php` | Peta UI + JS controller | Line 600-700 |
| `routes/web.php` | Route `/api/disaster-data` | Line 8 |
| `app/Models/Report.php` | Model dengan field baru | Line 5-15 |

---

## 🎓 Belajar Lebih Lanjut

- **Leaflet.js Docs**: https://leafletjs.com/
- **OpenStreetMap**: https://www.openstreetmap.org/
- **Laravel API Resources**: https://laravel.com/docs/api-resources
- **Real-time WebSockets**: https://laravel.com/docs/broadcasting

---

**Terakhir Update**: 2026-03-06  
**Status**: ✅ Production Ready  
**Support**: Hubungi tim development
