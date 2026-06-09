@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
            <div class="bg-gradient-to-r from-cyan-600 to-blue-700 px-8 py-6">
                <h1 class="text-2xl font-bold text-white">Tambah Laporan Bencana</h1>
                <p class="text-cyan-100 text-sm mt-1">Masukkan detail kejadian bencana baru untuk dipublikasikan.</p>
            </div>

            <form action="{{ route('admin.reports.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Judul Laporan</label>
                        <input type="text" name="title" required class="w-full rounded-xl border-slate-200 focus:ring-cyan-500 focus:border-cyan-500" placeholder="Contoh: Banjir Bandang Surabaya">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Jenis Bencana</label>
                        <select name="disaster_type" required class="w-full rounded-xl border-slate-200 focus:ring-cyan-500 focus:border-cyan-500">
                            <option value="Banjir">Banjir</option>
                            <option value="Gempa Bumi">Gempa Bumi</option>
                            <option value="Tanah Longsor">Tanah Longsor</option>
                            <option value="Kebakaran Hutan">Kebakaran Hutan</option>
                            <option value="Tsunami">Tsunami</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Lokasi (Nama Wilayah)</label>
                    <input type="text" name="location" required class="w-full rounded-xl border-slate-200 focus:ring-cyan-500 focus:border-cyan-500" placeholder="Contoh: Kec. Wonokromo, Surabaya">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Latitude</label>
                        <input type="number" step="any" name="latitude" required class="w-full rounded-xl border-slate-200 focus:ring-cyan-500 focus:border-cyan-500" placeholder="-7.2504">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Longitude</label>
                        <input type="number" step="any" name="longitude" required class="w-full rounded-xl border-slate-200 focus:ring-cyan-500 focus:border-cyan-500" placeholder="112.7688">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Tanggal Kejadian</label>
                        <input type="date" name="report_date" required class="w-full rounded-xl border-slate-200 focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Status Bencana</label>
                        <select name="disaster_status" required class="w-full rounded-xl border-slate-200 focus:ring-cyan-500 focus:border-cyan-500">
                            <option value="Terjadi">Terjadi (Aktif)</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Prediksi">Prediksi</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Sumber Data</label>
                    <input type="text" name="source" required class="w-full rounded-xl border-slate-200 focus:ring-cyan-500 focus:border-cyan-500" value="BUMN">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Deskripsi Kejadian</label>
                    <textarea name="description" rows="4" required class="w-full rounded-xl border-slate-200 focus:ring-cyan-500 focus:border-cyan-500" placeholder="Jelaskan detail kejadian bencana..."></textarea>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition">Batal</a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-cyan-600 text-white font-bold hover:bg-cyan-700 shadow-lg shadow-cyan-200 transition">Simpan Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
