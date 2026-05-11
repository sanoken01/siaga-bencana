<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->get();
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'disaster_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'report_date' => 'required|date',
            'description' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status' => 'nullable|in:Diproses,Diverifikasi,Selesai',
            'disaster_status' => 'nullable|in:Terjadi,Prediksi,Selesai',
        ]);

        Report::create(array_merge(
            $request->only([
                'title',
                'disaster_type',
                'location',
                'report_date',
                'description',
                'latitude',
                'longitude',
                'status',
                'disaster_status',
            ]),
            [
                'disaster_status' => $request->input('disaster_status', 'Prediksi'),
                'source' => 'Laporan Cepat',
                'prediction_percentage' => 0,
            ]
        ));

        return redirect()->route('reports.index')
                         ->with('success', 'Laporan berhasil ditambahkan!');
    }

    public function edit(Report $report)
    {
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'disaster_type' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'report_date' => 'required|date',
            'description' => 'required|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'status' => 'nullable|in:Diproses,Diverifikasi,Selesai',
            'disaster_status' => 'nullable|in:Terjadi,Prediksi,Selesai',
        ]);

        $report->update(array_merge(
            $request->only([
                'title',
                'disaster_type',
                'location',
                'report_date',
                'description',
                'latitude',
                'longitude',
                'status',
                'disaster_status',
            ]),
            ['disaster_status' => $request->input('disaster_status', $report->disaster_status ?? 'Prediksi')]
        ));

        return redirect()->route('reports.index')
                         ->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index')
                         ->with('success', 'Laporan berhasil dihapus.');
    }

    public function getDisasterData()
    {
        $disasters = Report::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->where('disaster_type', '!=', '')
            ->latest('report_date')
            ->get()
            ->map(function ($disaster) {
                return [
                    'id' => $disaster->id,
                    'title' => $disaster->title,
                    'type' => $disaster->disaster_type,
                    'location' => $disaster->location,
                    'lat' => (float) $disaster->latitude,
                    'lng' => (float) $disaster->longitude,
                    'date' => $disaster->report_date->format('Y-m-d H:i'),
                    'description' => $disaster->description,
                    'status' => $disaster->disaster_status,
                    'prediction' => $disaster->prediction_percentage,
                    'color' => $this->getMarkerColor($disaster),
                ];
            });

        return response()->json($disasters);
    }

    private function getMarkerColor($disaster)
    {
        if ($disaster->disaster_status === 'Terjadi') {
            return '#FF0000'; // Merah untuk bencana sedang terjadi
        } elseif ($disaster->disaster_status === 'Selesai') {
            return '#FFFFFF'; // Putih untuk bencana selesai
        } else { // Prediksi
            if ($disaster->prediction_percentage >= 75) {
                return '#d13612'; // Merah gelap untuk prediksi sangat tinggi
            } elseif ($disaster->prediction_percentage >= 50) {
                return '#FFA500'; // Orange untuk prediksi tinggi
            } elseif ($disaster->prediction_percentage >= 30) {
                return '#FFD700'; // Kuning untuk prediksi sedang
            } else {
                return '#9ddf59'; // Hijau muda untuk prediksi rendah
            }
        }
    }
}