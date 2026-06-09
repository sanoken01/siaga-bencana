@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-sky-50 via-cyan-50 to-blue-100 py-12">
    <div class="container mx-auto max-w-3xl px-4">
        <a href="{{ route('admin.dashboard', ['tab' => 'bencana']) }}" class="mb-5 inline-flex items-center gap-2 rounded-full border border-sky-200 bg-white/85 px-4 py-2 text-sm font-semibold text-sky-800 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <div class="overflow-hidden rounded-[28px] border border-white/70 bg-white shadow-[0_28px_70px_rgba(14,116,144,0.14)]">
            <div class="bg-gradient-to-r from-cyan-600 via-sky-600 to-blue-700 px-8 py-7 text-white">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-100">Admin Panel</p>
                <h1 class="mt-2 text-2xl font-bold">Edit Laporan Bencana</h1>
                <p class="mt-1 text-sm text-cyan-100">Perbarui informasi laporan yang sudah masuk ke sistem.</p>
            </div>

            <form action="{{ route('admin.reports.update', $report) }}" method="POST" class="space-y-6 p-8">
                @csrf
                @method('PUT')

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Judul Laporan</label>
                        <input type="text" name="title" value="{{ old('title', $report->title) }}" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="Contoh: Banjir Bandang Surabaya">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Jenis Bencana</label>
                        <select name="disaster_type" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500">
                            @foreach(['Banjir', 'Gempa Bumi', 'Tanah Longsor', 'Kebakaran Hutan', 'Tsunami', 'Lainnya'] as $type)
                                <option value="{{ $type }}" @selected(old('disaster_type', $report->disaster_type) === $type)>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $report->location) }}" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="Contoh: Kec. Wonokromo, Surabaya">
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Latitude</label>
                        <input type="number" step="any" name="latitude" value="{{ old('latitude', $report->latitude) }}" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="-7.2504">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Longitude</label>
                        <input type="number" step="any" name="longitude" value="{{ old('longitude', $report->longitude) }}" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="112.7688">
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Tanggal Kejadian</label>
                        <input type="date" name="report_date" value="{{ old('report_date', optional($report->report_date)->format('Y-m-d')) }}" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Status Bencana</label>
                        <select name="disaster_status" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500">
                            @foreach(['Terjadi' => 'Terjadi', 'Selesai' => 'Selesai', 'Prediksi' => 'Prediksi'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('disaster_status', $report->disaster_status) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Status Data</label>
                        <select name="status" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500">
                            @foreach(['Diproses', 'Diverifikasi', 'Selesai'] as $status)
                                <option value="{{ $status }}" @selected(old('status', $report->status) === $status)>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Target Donasi</label>
                        <input type="number" min="0" name="goal_amount" value="{{ old('goal_amount', $report->goal_amount) }}" class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="0">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Sumber Data</label>
                    <input type="text" name="source" value="{{ old('source', $report->source) }}" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="BUMN / API / PetaBencana">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Deskripsi</label>
                    <textarea name="description" rows="4" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="Jelaskan detail kejadian bencana...">{{ old('description', $report->description) }}</textarea>
                </div>

                <label class="flex items-center gap-3 rounded-2xl border border-sky-100 bg-sky-50/70 px-4 py-3 text-sm font-semibold text-sky-900">
                    <input type="checkbox" name="is_confirmed" value="1" @checked(old('is_confirmed', $report->is_confirmed)) class="h-4 w-4 rounded border-sky-300 text-cyan-600 focus:ring-cyan-500">
                    Laporan sudah dikonfirmasi dan dipublikasikan
                </label>

                <div class="flex flex-wrap items-center justify-end gap-3 pt-2">
                    <a href="{{ route('admin.dashboard', ['tab' => 'bencana']) }}" class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 font-semibold text-slate-600 transition hover:bg-slate-50">Batal</a>
                    <button type="submit" class="rounded-xl bg-gradient-to-r from-cyan-600 to-blue-700 px-5 py-2.5 font-bold text-white shadow-lg shadow-cyan-200 transition hover:scale-[1.01]">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection