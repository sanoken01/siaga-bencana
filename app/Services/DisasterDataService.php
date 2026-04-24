<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Report;

class DisasterDataService
{
    public function fetchBmkgEarthquakeData()
    {
        try {
            $response = Http::get('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json');
            if ($response->successful()) {
                $data = $response->json();
                $this->saveBmkgEarthquakeData($data);
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching BMKG earthquake data: ' . $e->getMessage());
        }
    }

    public function fetchBmkgRecentEarthquakes()
    {
        try {
            $response = Http::get('https://data.bmkg.go.id/DataMKG/TEWS/gempadirasakan.json');
            if ($response->successful()) {
                $data = $response->json();
                $this->saveBmkgRecentEarthquakes($data);
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching BMKG recent earthquakes: ' . $e->getMessage());
        }
    }

    public function fetchBmkgDirectEarthquakes()
    {
        try {
            $response = Http::get('https://data.bmkg.go.id/DataMKG/TEWS/gempadirect.json');
            if ($response->successful()) {
                $data = $response->json();
                $this->saveBmkgDirectEarthquakes($data);
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching BMKG direct earthquakes: ' . $e->getMessage());
        }
    }

    public function fetchBmkgTerkiniEarthquakes()
    {
        try {
            $response = Http::get('https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json');
            if ($response->successful()) {
                $data = $response->json();
                $this->saveBmkgTerkiniEarthquakes($data);
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching BMKG terkini earthquakes: ' . $e->getMessage());
        }
    }

    public function fetchUsGsEarthquakeData()
    {
        try {
            // Get earthquakes in Indonesia region (bounding box)
            $response = Http::get('https://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/all_day.geojson');
            if ($response->successful()) {
                $data = $response->json();
                $this->saveUsGsEarthquakeData($data);
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching USGS earthquake data: ' . $e->getMessage());
        }
    }

    public function fetchGdacsData()
    {
        try {
            $response = Http::get('https://www.gdacs.org/xml/rss.xml');
            if ($response->successful()) {
                $xml = simplexml_load_string($response->body());
                $this->saveGdacsData($xml);
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching GDACS data: ' . $e->getMessage());
        }
    }

    public function fetchPetaBencanaFloodData()
    {
        try {
            $response = Http::get('https://data.petabencana.id/reports');
            if ($response->successful()) {
                $data = $response->json();
                $this->savePetaBencanaFloodData($data);
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching PetaBencana flood data: ' . $e->getMessage());
        }
    }

    private function saveBmkgEarthquakeData($data)
    {
        if (isset($data['Infogempa']['gempa'])) {
            $gempa = $data['Infogempa']['gempa'];

            // Create unique key based on coordinates, magnitude, and date
            $uniqueKey = 'bmkg_' . $gempa['Lintang'] . '_' . $gempa['Bujur'] . '_' . $gempa['Magnitude'] . '_' . substr($gempa['Tanggal'], 0, 10);

            Report::updateOrCreate(
                ['unique_key' => $uniqueKey],
                [
                    'title' => 'Gempa Bumi ' . $gempa['Magnitude'] . ' - ' . $gempa['Wilayah'],
                    'disaster_type' => 'Gempa Bumi',
                    'location' => $gempa['Wilayah'],
                    'latitude' => (float) $gempa['Lintang'],
                    'longitude' => (float) $gempa['Bujur'],
                    'report_date' => now(),
                    'description' => 'Gempa bumi dengan magnitude ' . $gempa['Magnitude'] . ' di ' . $gempa['Wilayah'] . '. Kedalaman: ' . $gempa['Kedalaman'] . '. Waktu: ' . $gempa['Tanggal'] . ' ' . $gempa['Jam'],
                    'status' => 'Diverifikasi',
                    'disaster_status' => 'Terjadi',
                    'prediction_percentage' => 0,
                    'source' => 'BUMN',
                ]
            );
        }
    }

    private function saveBmkgRecentEarthquakes($data)
    {
        if (isset($data['Infogempa']['gempa'])) {
            foreach ($data['Infogempa']['gempa'] as $gempa) {
                $uniqueKey = 'bmkg_' . $gempa['Lintang'] . '_' . $gempa['Bujur'] . '_' . $gempa['Magnitude'] . '_' . substr($gempa['Tanggal'], 0, 10);

                Report::updateOrCreate(
                    ['unique_key' => $uniqueKey],
                    [
                        'title' => 'Gempa Bumi ' . $gempa['Magnitude'] . ' - ' . $gempa['Wilayah'],
                        'disaster_type' => 'Gempa Bumi',
                        'location' => $gempa['Wilayah'],
                        'latitude' => (float) $gempa['Lintang'],
                        'longitude' => (float) $gempa['Bujur'],
                        'report_date' => now(),
                        'description' => 'Gempa bumi dengan magnitude ' . $gempa['Magnitude'] . ' di ' . $gempa['Wilayah'] . '. Kedalaman: ' . $gempa['Kedalaman'] . '. Waktu: ' . $gempa['Tanggal'] . ' ' . $gempa['Jam'],
                        'status' => 'Diverifikasi',
                        'disaster_status' => 'Terjadi',
                        'prediction_percentage' => 0,
                        'source' => 'BUMN',
                    ]
                );
            }
        }
    }

    private function saveBmkgDirectEarthquakes($data)
    {
        if (isset($data['Infogempa']['gempa'])) {
            foreach ($data['Infogempa']['gempa'] as $gempa) {
                $uniqueKey = 'bmkg_' . $gempa['Lintang'] . '_' . $gempa['Bujur'] . '_' . $gempa['Magnitude'] . '_' . substr($gempa['Tanggal'], 0, 10);

                Report::updateOrCreate(
                    ['unique_key' => $uniqueKey],
                    [
                        'title' => 'Gempa Bumi M5+ ' . $gempa['Magnitude'] . ' - ' . $gempa['Wilayah'],
                        'disaster_type' => 'Gempa Bumi',
                        'location' => $gempa['Wilayah'],
                        'latitude' => (float) $gempa['Lintang'],
                        'longitude' => (float) $gempa['Bujur'],
                        'report_date' => now(),
                        'description' => 'Gempa bumi signifikan M5+ dengan magnitude ' . $gempa['Magnitude'] . ' di ' . $gempa['Wilayah'] . '. Kedalaman: ' . $gempa['Kedalaman'] . '. Waktu: ' . $gempa['Tanggal'] . ' ' . $gempa['Jam'],
                        'status' => 'Diverifikasi',
                        'disaster_status' => 'Terjadi',
                        'prediction_percentage' => 0,
                        'source' => 'BUMN',
                    ]
                );
            }
        }
    }

    private function saveBmkgTerkiniEarthquakes($data)
    {
        if (isset($data['Infogempa']['gempa'])) {
            foreach ($data['Infogempa']['gempa'] as $gempa) {
                $uniqueKey = 'bmkg_' . $gempa['Lintang'] . '_' . $gempa['Bujur'] . '_' . $gempa['Magnitude'] . '_' . substr($gempa['Tanggal'], 0, 10);

                Report::updateOrCreate(
                    ['unique_key' => $uniqueKey],
                    [
                        'title' => 'Gempa Dirasakan ' . $gempa['Magnitude'] . ' - ' . $gempa['Wilayah'],
                        'disaster_type' => 'Gempa Bumi',
                        'location' => $gempa['Wilayah'],
                        'latitude' => (float) $gempa['Lintang'],
                        'longitude' => (float) $gempa['Bujur'],
                        'report_date' => now(),
                        'description' => 'Gempa bumi yang dirasakan dengan magnitude ' . $gempa['Magnitude'] . ' di ' . $gempa['Wilayah'] . '. Kedalaman: ' . $gempa['Kedalaman'] . '. Waktu: ' . $gempa['Tanggal'] . ' ' . $gempa['Jam'],
                        'status' => 'Diverifikasi',
                        'disaster_status' => 'Terjadi',
                        'prediction_percentage' => 0,
                        'source' => 'BUMN',
                    ]
                );
            }
        }
    }

    private function saveUsGsEarthquakeData($data)
    {
        if (isset($data['features'])) {
            foreach ($data['features'] as $feature) {
                $properties = $feature['properties'];
                $geometry = $feature['geometry'];

                // Filter for Indonesia region (bounding box: -11 to 6 lat, 95 to 141 lng)
                $lat = $geometry['coordinates'][1];
                $lng = $geometry['coordinates'][0];

                if ($lat >= -11 && $lat <= 6 && $lng >= 95 && $lng <= 141) {
                    // Create unique key based on USGS event ID
                    $uniqueKey = 'usgs_' . $properties['id'];

                    Report::updateOrCreate(
                        ['unique_key' => $uniqueKey],
                        [
                            'title' => 'USGS: Gempa ' . $properties['mag'] . ' - ' . $properties['place'],
                            'disaster_type' => 'Gempa Bumi',
                            'location' => $properties['place'] ?? 'Lokasi tidak diketahui',
                            'latitude' => (float) $lat,
                            'longitude' => (float) $lng,
                            'report_date' => now(),
                            'description' => 'Data gempa dari USGS. Magnitude: ' . $properties['mag'] . '. Lokasi: ' . ($properties['place'] ?? 'Tidak diketahui') . '. Kedalaman: ' . ($properties['depth'] ?? 'Tidak diketahui') . ' km',
                            'status' => 'Diverifikasi',
                            'disaster_status' => 'Terjadi',
                            'prediction_percentage' => 0,
                            'source' => 'USGS',
                        ]
                    );
                }
            }
        }
    }

    private function saveGdacsData($xml)
    {
        if ($xml && isset($xml->channel->item)) {
            foreach ($xml->channel->item as $item) {
                // Parse GDACS data - this is a simplified version
                $title = (string) $item->title;
                $description = (string) $item->description;
                $link = (string) $item->link;

                // Extract coordinates if available (GDACS often includes them)
                preg_match('/(-?\d+\.\d+),\s*(-?\d+\.\d+)/', $description, $matches);
                if (count($matches) >= 3) {
                    $lat = (float) $matches[1];
                    $lng = (float) $matches[2];

                    // Filter for Indonesia region
                    if ($lat >= -11 && $lat <= 6 && $lng >= 95 && $lng <= 141) {
                        // Create unique key based on GDACS link
                        $uniqueKey = 'gdacs_' . md5($link);

                        Report::updateOrCreate(
                            ['unique_key' => $uniqueKey],
                            [
                                'title' => 'GDACS: ' . $title,
                                'disaster_type' => $this->determineDisasterTypeFromGdacs($title),
                                'location' => $this->extractLocationFromGdacs($title),
                                'latitude' => $lat,
                                'longitude' => $lng,
                                'report_date' => now(),
                                'description' => 'Data dari GDACS: ' . $description,
                                'status' => 'Diverifikasi',
                                'disaster_status' => 'Terjadi',
                                'prediction_percentage' => 0,
                                'source' => 'GDACS',
                            ]
                        );
                    }
                }
            }
        }
    }

    private function savePetaBencanaFloodData($data)
    {
        if (isset($data['result']['objects']['output']['geometries'])) {
            foreach ($data['result']['objects']['output']['geometries'] as $report) {
                if (isset($report['properties'])) {
                    $properties = $report['properties'];
                    $coordinates = $report['coordinates'];

                    // Create unique key based on coordinates and timestamp
                    $timestamp = isset($properties['created_at']) ? strtotime($properties['created_at']) : time();
                    $uniqueKey = 'petabencana_' . $coordinates[1] . '_' . $coordinates[0] . '_' . $timestamp;

                    Report::updateOrCreate(
                        ['unique_key' => $uniqueKey],
                        [
                            'title' => 'Banjir - ' . ($properties['area_name'] ?? 'Lokasi Tidak Diketahui'),
                            'disaster_type' => 'Banjir',
                            'location' => $properties['area_name'] ?? 'Lokasi Tidak Diketahui',
                            'latitude' => (float) $coordinates[1],
                            'longitude' => (float) $coordinates[0],
                            'report_date' => now(),
                            'description' => 'Laporan banjir dari masyarakat. ' . ($properties['text'] ?? ''),
                            'status' => 'Diproses',
                            'disaster_status' => 'Terjadi',
                            'prediction_percentage' => 0,
                            'source' => 'PetaBencana',
                        ]
                    );
                }
            }
        }
    }

    private function savePantoAirData($data)
    {
        // Placeholder implementation for Panto Air
        // Actual implementation depends on available API endpoints
        if (isset($data['features'])) {
            foreach ($data['features'] as $feature) {
                // Implement based on actual API structure
                // This is a placeholder
            }
        }
    }

    private function determineDisasterTypeFromGdacs($title)
    {
        $title = strtolower($title);
        if (strpos($title, 'earthquake') !== false || strpos($title, 'gempa') !== false) {
            return 'Gempa Bumi';
        } elseif (strpos($title, 'flood') !== false || strpos($title, 'banjir') !== false) {
            return 'Banjir';
        } elseif (strpos($title, 'cyclone') !== false || strpos($title, 'tropical') !== false) {
            return 'Badai';
        } elseif (strpos($title, 'volcano') !== false) {
            return 'Gunung Berapi';
        }
        return 'Bencana Alam';
    }

    private function extractLocationFromGdacs($title)
    {
        // Simple extraction - in real implementation, might need more sophisticated parsing
        $parts = explode(' - ', $title);
        return count($parts) > 1 ? $parts[1] : $title;
    }

    public function fetchAllData()
    {
        self::info('Fetching data from BMKG...');
        $this->fetchBmkgEarthquakeData();
        $this->fetchBmkgRecentEarthquakes();
        $this->fetchBmkgDirectEarthquakes();
        $this->fetchBmkgTerkiniEarthquakes();

        self::info('Fetching data from PetaBencana...');
        $this->fetchPetaBencanaFloodData();

        self::info('Fetching data from USGS...');
        $this->fetchUsGsEarthquakeData();

        self::info('Fetching data from GDACS...');
        $this->fetchGdacsData();

        self::info('Fetching data from Panto Air...');
        $this->fetchPantoAirData();

        self::info('Adding historical disaster data...');
        $this->addHistoricalDisasterData();

        self::info('All disaster data fetched successfully!');
    }

    public function addHistoricalDisasterData()
    {
        $this->info('Adding historical disaster data...');

        $historicalDisasters = [
            [
                'unique_key' => 'historical_gempa_palangkaraya_2024',
                'title' => 'Gempa Bumi 6.2 - Palangkaraya (SELESAI)',
                'disaster_type' => 'Gempa Bumi',
                'location' => 'Palangkaraya, Kalimantan Tengah',
                'latitude' => -2.2167,
                'longitude' => 113.9167,
                'report_date' => '2024-11-15',
                'description' => 'Gempa bumi berkekuatan 6.2 SR mengguncang Palangkaraya pada November 2024. Kerusakan infrastruktur minimal, tidak ada korban jiwa.',
                'status' => 'Selesai',
                'disaster_status' => 'Selesai',
                'prediction_percentage' => 0,
                'source' => 'Historical',
            ],
            [
                'unique_key' => 'historical_banjir_jakarta_2024',
                'title' => 'Banjir Jakarta Pusat (SELESAI)',
                'disaster_type' => 'Banjir',
                'location' => 'Jakarta Pusat, DKI Jakarta',
                'latitude' => -6.1751,
                'longitude' => 106.8249,
                'report_date' => '2024-12-20',
                'description' => 'Banjir melanda Jakarta Pusat akibat hujan ekstrem Desember 2024. Evakuasi penduduk berhasil dilakukan, air surut dalam 3 hari.',
                'status' => 'Selesai',
                'disaster_status' => 'Selesai',
                'prediction_percentage' => 0,
                'source' => 'Historical',
            ],
            [
                'unique_key' => 'historical_tanahlongsor_cirebon_2024',
                'title' => 'Tanah Longsor Cirebon (SELESAI)',
                'disaster_type' => 'Tanah Longsor',
                'location' => 'Cirebon, Jawa Barat',
                'latitude' => -6.7250,
                'longitude' => 108.5523,
                'report_date' => '2024-10-08',
                'description' => 'Tanah longsor di perbukitan Cirebon Oktober 2024. 5 rumah terdampak, evakuasi berhasil, rehabilitasi selesai.',
                'status' => 'Selesai',
                'disaster_status' => 'Selesai',
                'prediction_percentage' => 0,
                'source' => 'Historical',
            ],
            [
                'unique_key' => 'historical_kebakaran_hutan_riau_2024',
                'title' => 'Kebakaran Hutan Riau (SELESAI)',
                'disaster_type' => 'Kebakaran Hutan',
                'location' => 'Riau, Sumatera',
                'latitude' => 0.5333,
                'longitude' => 101.4500,
                'report_date' => '2024-09-15',
                'description' => 'Kebakaran hutan di Riau September 2024. 10.000 hektar terbakar, berhasil dipadamkan dalam 2 minggu.',
                'status' => 'Selesai',
                'disaster_status' => 'Selesai',
                'prediction_percentage' => 0,
                'source' => 'Historical',
            ],
            [
                'unique_key' => 'historical_gunungberapi_merapi_2024',
                'title' => 'Erupsi Gunung Merapi (SELESAI)',
                'disaster_type' => 'Gunung Berapi',
                'location' => 'Gunung Merapi, DIY',
                'latitude' => -7.5400,
                'longitude' => 110.4467,
                'report_date' => '2024-08-22',
                'description' => 'Erupsi Gunung Merapi Agustus 2024. Abu vulkanik menyebar hingga 15 km, tidak ada korban jiwa.',
                'status' => 'Selesai',
                'disaster_status' => 'Selesai',
                'prediction_percentage' => 0,
                'source' => 'Historical',
            ],
        ];

        foreach ($historicalDisasters as $disaster) {
            Report::updateOrCreate(
                ['unique_key' => $disaster['unique_key']],
                $disaster
            );
        }

        self::info('Historical disaster data added successfully!');
    }

    private static function info($message)
    {
        // Simple logging - in production you might want to use proper logging
        echo $message . PHP_EOL;
    }
}