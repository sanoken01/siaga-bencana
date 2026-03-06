<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class DisasterSeeder extends Seeder
{
    public function run(): void
    {
        // Data bencana di Jawa
        Report::create([
            'title' => 'Gempa Bumi Yogyakarta - Magnitude 5.2',
            'disaster_type' => 'Gempa Bumi',
            'location' => 'Yogyakarta',
            'latitude' => -7.7956,
            'longitude' => 110.3695,
            'report_date' => now(),
            'description' => 'Gempa bumi berkekuatan 5.2 SR mengguncang Yogyakarta dan sekitarnya',
            'status' => 'Diverifikasi',
            'prediction_percentage' => 0,
            'disaster_status' => 'ongoing',
        ]);

        Report::create([
            'title' => 'Banjir Bandung - Lokasi Cicadas',
            'disaster_type' => 'Banjir',
            'location' => 'Bandung, Jawa Barat',
            'latitude' => -6.9147,
            'longitude' => 107.6098,
            'report_date' => now()->subDays(2),
            'description' => 'Banjir di area Cicadas telah surut, tidak ada korban jiwa',
            'status' => 'Selesai',
            'prediction_percentage' => 0,
            'disaster_status' => 'ended',
        ]);

        Report::create([
            'title' => 'Tanah Longsor - Gunung Merapi - Sleman',
            'disaster_type' => 'Tanah Longsor',
            'location' => 'Sleman, DIY',
            'latitude' => -7.5941,
            'longitude' => 110.4430,
            'report_date' => now()->subDay(),
            'description' => 'Potensi tanah longsor akibat aktivitas vulkanik Merapi',
            'status' => 'Diproses',
            'prediction_percentage' => 65,
            'disaster_status' => 'predicted',
        ]);

        Report::create([
            'title' => 'Tsunami Warning - Jawa Timur',
            'disaster_type' => 'Tsunami',
            'location' => 'Surabaya, Jawa Timur',
            'latitude' => -7.2506,
            'longitude' => 112.7508,
            'report_date' => now(),
            'description' => 'Potensi tsunami berdasarkan pergerakan lempeng samudra',
            'status' => 'Diproses',
            'prediction_percentage' => 35,
            'disaster_status' => 'predicted',
        ]);

        Report::create([
            'title' => 'Banjir Jakarta - DKI Jakarta',
            'disaster_type' => 'Banjir',
            'location' => 'Jakarta, DKI Jakarta',
            'latitude' => -6.2088,
            'longitude' => 106.8456,
            'report_date' => now()->subHours(3),
            'description' => 'Banjir di wilayah Jakarta akibat hujan lebat dan meluapnya sungai',
            'status' => 'Diverifikasi',
            'prediction_percentage' => 0,
            'disaster_status' => 'ongoing',
        ]);

        Report::create([
            'title' => 'Gempa Susulan - Cirebon',
            'disaster_type' => 'Gempa Bumi',
            'location' => 'Cirebon, Jawa Barat',
            'latitude' => -6.7034,
            'longitude' => 108.4689,
            'report_date' => now()->subHours(1),
            'description' => 'Gempa susulan magnitude 3.8 SR di wilayah Cirebon',
            'status' => 'Diverifikasi',
            'prediction_percentage' => 0,
            'disaster_status' => 'ongoing',
        ]);

        Report::create([
            'title' => 'Potensi Tanah Longsor - Bogor',
            'disaster_type' => 'Tanah Longsor',
            'location' => 'Bogor, Jawa Barat',
            'latitude' => -6.5971,
            'longitude' => 106.7856,
            'report_date' => now(),
            'description' => 'Cuaca ekstrem memberikan potensi tanah longsor di daerah perbukitan',
            'status' => 'Diproses',
            'prediction_percentage' => 45,
            'disaster_status' => 'predicted',
        ]);

        Report::create([
            'title' => 'Gempa Lombok (Dampak ke Jawa)',
            'disaster_type' => 'Gempa Bumi',
            'location' => 'Semarang, Jawa Tengah',
            'latitude' => -6.9667,
            'longitude' => 110.4167,
            'report_date' => now()->subHours(2),
            'description' => 'Gempa Lombok terasa dampaknya hingga ke Jawa Tengah',
            'status' => 'Diverifikasi',
            'prediction_percentage' => 0,
            'disaster_status' => 'ongoing',
        ]);
    }
}
            'report_date' => now()->subDays(5),
            'description' => 'Gempa di Lombok terasa hingga ke Jawa Tengah, sudah berakhir',
            'status' => 'Selesai',
            'prediction_percentage' => 0,
            'disaster_status' => 'ended',
        ]);

        Report::create([
            'title' => 'Banjir Bandung Utara - Selesai',
            'disaster_type' => 'Banjir',
            'location' => 'Bandung Utara, Jawa Barat',
            'latitude' => -6.8830,
            'longitude' => 107.6191,
            'report_date' => now()->subDays(3),
            'description' => 'Air telah surut, normalitas mulai pulih',
            'status' => 'Selesai',
            'prediction_percentage' => 0,
            'disaster_status' => 'ended',
        ]);

        Report::create([
            'title' => 'Peringatan Gempa - Trenggalek',
            'disaster_type' => 'Gempa Bumi',
            'location' => 'Trenggalek, Jawa Timur',
            'latitude' => -8.6547,
            'longitude' => 111.7100,
            'report_date' => now(),
            'description' => 'Zona gempa aktif dengan potensi gempa sedang hingga kuat',
            'status' => 'Diproses',
            'prediction_percentage' => 55,
            'disaster_status' => 'predicted',
        ]);
    }
}
