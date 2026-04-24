<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Report;

class JavaDisasterSeeder extends Seeder
{
    public function run(): void
    {
        $disasters = [
            // Gempa Bumi di Jawa Timur (Surabaya)
            [
                'title' => 'Gempa Bumi Magnitude 5.2 - Surabaya',
                'disaster_type' => 'Gempa Bumi',
                'location' => 'Surabaya, Jawa Timur',
                'latitude' => -7.2504,
                'longitude' => 112.7521,
                'report_date' => '2026-03-06',
                'description' => 'Gempa bumi dengan magnitude 5.2 mengguncang Kota Surabaya dan sekitarnya. Tidak ada laporan kerusakan serius saat ini.',
                'status' => 'Diverifikasi',
                'disaster_status' => 'Terjadi',
                'prediction_percentage' => 0,
                'source' => 'BUMN',
            ],
            // Banjir di Jakarta
            [
                'title' => 'Banjir Wilayah Jakarta Pusat',
                'disaster_type' => 'Banjir',
                'location' => 'Jakarta Pusat, DKI Jakarta',
                'latitude' => -6.1751,
                'longitude' => 106.8249,
                'report_date' => '2026-03-06',
                'description' => 'Banjir terjadi di beberapa kelurahan Jakarta Pusat akibat curah hujan tinggi. Tim darurat sudah bergerak untuk evakuasi.',
                'status' => 'Diproses',
                'disaster_status' => 'Terjadi',
                'prediction_percentage' => 0,
                'source' => 'BUMN',
            ],
            // Prediksi Gempa Bandung Tinggi
            [
                'title' => 'Prediksi Gempa Zona Bandung',
                'disaster_type' => 'Gempa Bumi',
                'location' => 'Bandung, Jawa Barat',
                'latitude' => -6.9175,
                'longitude' => 107.6015,
                'report_date' => '2026-03-05',
                'description' => 'Prediksi gempa dengan probability tinggi (65%) di zona Bandung berdasarkan aktivitas seismik terkini.',
                'status' => 'Diverifikasi',
                'disaster_status' => 'Prediksi',
                'prediction_percentage' => 65,
                'source' => 'BUMN',
            ],
            // Tanah Longsor di Yogyakarta
            [
                'title' => 'Tanah Longsor - Kabupaten Sleman',
                'disaster_type' => 'Tanah Longsor',
                'location' => 'Kecamatan Turi, Sleman, DIY',
                'latitude' => -7.4467,
                'longitude' => 110.4402,
                'report_date' => '2026-03-06',
                'description' => 'Longsor terjadi pada lereng Gunung Merapi. Akses jalan terganggu, evakuasi penduduk di sekitar lokasi berlangsung.',
                'status' => 'Diproses',
                'disaster_status' => 'Terjadi',
                'prediction_percentage' => 0,
                'source' => 'BUMN',
            ],
            // Tsunami Warning di Semarang
            [
                'title' => 'Peringatan Tsunami Potensi - Semarang',
                'disaster_type' => 'Tsunami',
                'location' => 'Kota Semarang, Jawa Tengah',
                'latitude' => -6.9665,
                'longitude' => 110.4038,
                'report_date' => '2026-03-06',
                'description' => 'Potensi tsunami karena gempa di laut selatan Jawa. Masyarakat diminta siaga dan siap evakuasi.',
                'status' => 'Diproses',
                'disaster_status' => 'Prediksi',
                'prediction_percentage' => 72,
                'source' => 'BUMN',
            ],
            // Kehancuran Tamat Bencana
            [
                'title' => 'Gempa Lalu - Majalengka (SELESAI)',
                'disaster_type' => 'Gempa Bumi',
                'location' => 'Majalengka, Jawa Barat',
                'latitude' => -6.8976,
                'longitude' => 108.2146,
                'report_date' => '2026-03-04',
                'description' => 'Gempa yang terjadi kemarin telah selesai ditangani. Semua korban telah dievakuasi dan situasi sudah stabil.',
                'status' => 'Selesai',
                'disaster_status' => 'Selesai',
                'prediction_percentage' => 0,
                'source' => 'BUMN',
            ],
            // Prediksi Banjir Rendah
            [
                'title' => 'Prediksi Banjir Rendah - Cilacap',
                'disaster_type' => 'Banjir',
                'location' => 'Cilacap, Jawa Tengah',
                'latitude' => -7.7264,
                'longitude' => 109.0265,
                'report_date' => '2026-03-05',
                'description' => 'Prediksi banjir dengan probabilitas rendah (25%) untuk wilayah Cilacap musim penghujan mendatang.',
                'status' => 'Diverifikasi',
                'disaster_status' => 'Prediksi',
                'prediction_percentage' => 25,
                'source' => 'BUMN',
            ],
            // Prediksi Tanah Longsor Sedang
            [
                'title' => 'Prediksi Longsor - Bogor',
                'disaster_type' => 'Tanah Longsor',
                'location' => 'Bogor, Jawa Barat',
                'latitude' => -6.5971,
                'longitude' => 106.7856,
                'report_date' => '2026-03-06',
                'description' => 'Prediksi tanah longsor dengan probabilitas sedang (45%) di daerah perbukitan Bogor.',
                'status' => 'Diproses',
                'disaster_status' => 'Prediksi',
                'prediction_percentage' => 45,
                'source' => 'BUMN',
            ],
            // Prediksi Banjir Median
            [
                'title' => 'Prediksi Banjir - Cirebon',
                'disaster_type' => 'Banjir',
                'location' => 'Cirebon, Jawa Barat',
                'latitude' => -6.7250,
                'longitude' => 108.5523,
                'report_date' => '2026-03-05',
                'description' => 'Prediksi banjir dengan probabilitas sedang (35%) di wilayah Cirebon karena curah hujan tinggi.',
                'status' => 'Diproses',
                'disaster_status' => 'Prediksi',
                'prediction_percentage' => 35,
                'source' => 'BUMN',
            ],
            // Gempa Kediri
            [
                'title' => 'Gempa Tektonik - Kediri',
                'disaster_type' => 'Gempa Bumi',
                'location' => 'Kediri, Jawa Timur',
                'latitude' => -7.2498,
                'longitude' => 111.8689,
                'report_date' => '2026-03-06',
                'description' => 'Gempa tektonik magnitude 4.8 terjadi di sekitar Kediri. Warga diminta tetap waspada.',
                'status' => 'Diproses',
                'disaster_status' => 'Terjadi',
                'prediction_percentage' => 0,
                'source' => 'BUMN',
            ],
            // Longsor Prediksi Tinggi Puncak
            [
                'title' => 'Prediksi Tanah Longsor - Puncak',
                'disaster_type' => 'Tanah Longsor',
                'location' => 'Puncak, Bogor, Jawa Barat',
                'latitude' => -6.7426,
                'longitude' => 106.9896,
                'report_date' => '2026-03-05',
                'description' => 'Prediksi tanah longsor sangat tinggi (78%) di kawasan Puncak seiring cuaca ekstrem yang diprediksi.',
                'status' => 'Diverifikasi',
                'disaster_status' => 'Prediksi',
                'prediction_percentage' => 78,
                'source' => 'BUMN',
            ],
        ];

        foreach ($disasters as $disaster) {
            Report::create($disaster);
        }
    }
}
