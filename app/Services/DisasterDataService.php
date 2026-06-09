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

    private function parseBmkgCoordinate($coord)
    {
        if (empty($coord)) return 0;
        
        // Bersihkan string dari karakter non-numerik kecuali titik dan minus
        // BMKG sering mengembalikan format "7.25 LS" atau "110.20 BT"
        $numericValue = (float) preg_replace('/[^0-9.-]/', '', $coord);
        
        // Jika ada "LS" (Lintang Selatan) atau "S", maka nilai harus negatif
        if (str_contains(strtoupper($coord), 'LS') || str_contains(strtoupper($coord), 'S')) {
            return -abs($numericValue);
        }
        
        return $numericValue;
    }

    private function parseBmkgDateTime($tanggal, $jam)
    {
        try {
            // BMKG format contoh: Tanggal: 08 Jun 2026, Jam: 13:21:48 WIB
            // Bersihkan timezone (WIB, WITA, WIT)
            $jamClean = preg_replace('/\s+(WIB|WITA|WIT)$/i', '', $jam);
            
            // Map bulan Indonesia ke Inggris jika perlu
            $months = [
                'Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr', 'Mei' => 'May', 'Jun' => 'Jun',
                'Jul' => 'Jul', 'Agu' => 'Aug', 'Sep' => 'Sep', 'Okt' => 'Oct', 'Nov' => 'Nov', 'Des' => 'Dec'
            ];
            
            foreach ($months as $id => $en) {
                if (str_contains($tanggal, $id)) {
                    $tanggal = str_replace($id, $en, $tanggal);
                    break;
                }
            }

            return \Carbon\Carbon::parse($tanggal . ' ' . $jamClean);
        } catch (\Exception $e) {
            return now();
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
                    'latitude' => $this->parseBmkgCoordinate($gempa['Lintang']),
                    'longitude' => $this->parseBmkgCoordinate($gempa['Bujur']),
                    'report_date' => $this->parseBmkgDateTime($gempa['Tanggal'], $gempa['Jam']),
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
            $gempaList = $data['Infogempa']['gempa'];
            // Jika hanya satu gempa, jadikan array agar bisa diloop
            if (isset($gempaList['Tanggal'])) {
                $gempaList = [$gempaList];
            }
            
            foreach ($gempaList as $gempa) {
                $uniqueKey = 'bmkg_' . $gempa['Lintang'] . '_' . $gempa['Bujur'] . '_' . $gempa['Magnitude'] . '_' . substr($gempa['Tanggal'], 0, 10);

                Report::updateOrCreate(
                    ['unique_key' => $uniqueKey],
                    [
                        'title' => 'Gempa Bumi M5+ ' . $gempa['Magnitude'] . ' - ' . $gempa['Wilayah'],
                        'disaster_type' => 'Gempa Bumi',
                        'location' => $gempa['Wilayah'],
                        'latitude' => $this->parseBmkgCoordinate($gempa['Lintang']),
                        'longitude' => $this->parseBmkgCoordinate($gempa['Bujur']),
                        'report_date' => $this->parseBmkgDateTime($gempa['Tanggal'], $gempa['Jam']),
                        'description' => 'Gempa bumi signifikan (M >= 5.0) di ' . $gempa['Wilayah'] . '. Kedalaman: ' . $gempa['Kedalaman'] . '. Waktu: ' . $gempa['Tanggal'] . ' ' . $gempa['Jam'],
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
            $gempaList = $data['Infogempa']['gempa'];
            if (isset($gempaList['Tanggal'])) {
                $gempaList = [$gempaList];
            }

            foreach ($gempaList as $gempa) {
                $uniqueKey = 'bmkg_' . $gempa['Lintang'] . '_' . $gempa['Bujur'] . '_' . $gempa['Magnitude'] . '_' . substr($gempa['Tanggal'], 0, 10);

                Report::updateOrCreate(
                    ['unique_key' => $uniqueKey],
                    [
                        'title' => 'Gempa Dirasakan ' . $gempa['Magnitude'] . ' - ' . $gempa['Wilayah'],
                        'disaster_type' => 'Gempa Bumi',
                        'location' => $gempa['Wilayah'],
                        'latitude' => $this->parseBmkgCoordinate($gempa['Lintang']),
                        'longitude' => $this->parseBmkgCoordinate($gempa['Bujur']),
                        'report_date' => $this->parseBmkgDateTime($gempa['Tanggal'], $gempa['Jam']),
                        'description' => 'Gempa bumi yang dirasakan dengan magnitude ' . $gempa['Magnitude'] . ' di ' . $gempa['Wilayah'] . '. Skala MMI: ' . ($gempa['Dirasakan'] ?? '-') . '. Waktu: ' . $gempa['Tanggal'] . ' ' . $gempa['Jam'],
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

                if (!isset($geometry['coordinates'][1], $geometry['coordinates'][0])) {
                    continue;
                }

                // Filter for Indonesia region (bounding box: -11 to 6 lat, 95 to 141 lng)
                $lat = $geometry['coordinates'][1];
                $lng = $geometry['coordinates'][0];

                $place = strtolower($properties['place'] ?? '');
                if (strpos($place, 'philipp') !== false || strpos($place, 'taiwan') !== false || strpos($place, 'japan') !== false) {
                    continue;
                }

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
        $reports = [];

        if (isset($data['result']['objects']['output']['geometries'])) {
            $reports = $data['result']['objects']['output']['geometries'];
        } elseif (isset($data['result']['objects']['output']['features'])) {
            $reports = $data['result']['objects']['output']['features'];
        } elseif (isset($data['features'])) {
            $reports = $data['features'];
        }

        foreach ($reports as $report) {
            if (!isset($report['properties'])) {
                continue;
            }

            $properties = $report['properties'];
            $coordinates = $report['coordinates'] ?? ($report['geometry']['coordinates'] ?? null);
            if (!is_array($coordinates) || count($coordinates) < 2) {
                continue;
            }

            if (isset($properties['id'])) {
                $uniqueKey = 'petabencana_' . $properties['id'];
            } else {
                $uniqueKey = 'petabencana_' . md5(
                    ($properties['area_name'] ?? '') . '|' .
                    ($properties['text'] ?? '') . '|' .
                    ($coordinates[1] ?? '') . '|' .
                    ($coordinates[0] ?? '') . '|' .
                    ($properties['created_at'] ?? '')
                );
            }

            $reportDate = now();
            if (!empty($properties['created_at']) && strtotime($properties['created_at']) !== false) {
                $reportDate = date('Y-m-d H:i:s', strtotime($properties['created_at']));
            }

            Report::updateOrCreate(
                ['unique_key' => $uniqueKey],
                [
                    'title' => 'Banjir - ' . ($properties['area_name'] ?? 'Lokasi Tidak Diketahui'),
                    'disaster_type' => 'Banjir',
                    'location' => $properties['area_name'] ?? 'Lokasi Tidak Diketahui',
                    'latitude' => (float) $coordinates[1],
                    'longitude' => (float) $coordinates[0],
                    'report_date' => $reportDate,
                    'description' => 'Laporan banjir dari masyarakat. ' . ($properties['text'] ?? ''),
                    'status' => 'Diproses',
                    'disaster_status' => 'Terjadi',
                    'prediction_percentage' => 0,
                    'source' => 'PetaBencana',
                ]
            );
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
        self::info('🚀 Memulai penarikan data dari BMKG (BUMN)...');
        
        // 1. Gempa Bumi Terbaru (M >= 5.0 atau Berpotensi Tsunami)
        self::info('📡 Fetching: autogempa.json');
        $this->fetchBmkgEarthquakeData();
        
        // 2. Daftar 15 Gempa Bumi Terakhir (M >= 5.0)
        self::info('📡 Fetching: gempaterkini.json');
        $this->fetchBmkgRecentEarthquakes();
        
        // 3. Daftar 15 Gempa Bumi Dirasakan
        self::info('📡 Fetching: gempadirasakan.json');
        $this->fetchBmkgTerkiniEarthquakes();

        self::info('🚀 Memulai penarikan data dari PetaBencana...');
        $this->fetchPetaBencanaFloodData();

        self::info('🚀 Memulai penarikan data dari USGS & GDACS...');
        $this->fetchUsGsEarthquakeData();
        $this->fetchGdacsData();

        self::info('✅ Semua data bencana berhasil diperbarui!');
    }

    private static function info($message)
    {
        // Simple logging - in production you might want to use proper logging
        echo $message . PHP_EOL;
    }
}