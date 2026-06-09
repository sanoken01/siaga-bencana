@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Breadcrumb -->
        <nav class="mb-8 flex items-center gap-2 text-sm font-medium text-slate-500">
            <a href="{{ route('admin.dashboard') }}" class="transition hover:text-cyan-600">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-900">Tambah Laporan Bencana</span>
        </nav>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50">
            <div class="flex items-center gap-6 border-b border-slate-100 bg-slate-50/50 px-8 py-6">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-cyan-600 text-white shadow-lg shadow-cyan-200">
                    <i class="fa-solid fa-file-circle-plus text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">Tambah Laporan Baru</h1>
                    <p class="text-sm font-medium text-slate-500">Input data kejadian bencana untuk monitoring real-time.</p>
                </div>
            </div>

            <form action="{{ route('admin.reports.store') }}" method="POST" class="p-8">
                @csrf
                
                <div class="grid gap-8 lg:grid-cols-2">
                    <!-- Kolom Kiri -->
                    <div class="space-y-6">
                        <div class="group space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-cyan-600">Judul Kejadian</label>
                            <input type="text" name="title" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10" placeholder="Contoh: Banjir Bandang Surabaya">
                        </div>

                        <div class="group space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-cyan-600">Tipe Bencana</label>
                            <select name="disaster_type" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10">
                                <option value="Banjir">Banjir</option>
                                <option value="Gempa Bumi">Gempa Bumi</option>
                                <option value="Tanah Longsor">Tanah Longsor</option>
                                <option value="Tsunami">Tsunami</option>
                                <option value="Angin Puting Beliung">Angin Puting Beliung</option>
                            </select>
                        </div>

                        <div class="group space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-cyan-600">Lokasi Wilayah</label>
                            <input type="text" name="location" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10" placeholder="Contoh: Surabaya, Jawa Timur">
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-6">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="group space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-cyan-600">Latitude</label>
                                <input type="number" step="any" name="latitude" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10" placeholder="-7.2504">
                            </div>
                            <div class="group space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-cyan-600">Longitude</label>
                                <input type="number" step="any" name="longitude" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10" placeholder="112.7688">
                            </div>
                        </div>

                        <div class="grid gap-4 sm:grid-cols-2">
                            <div class="group space-y-2">
                                <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-cyan-600">Tanggal</label>
                                <input type="date" name="report_date" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10">
                            </div>
                        <div class="group space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-cyan-600">Status & Tingkat Risiko</label>
                            <div class="grid gap-3 sm:grid-cols-2">
                                <label class="relative flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-3 transition hover:bg-white has-[:checked]:border-red-500 has-[:checked]:bg-red-50 has-[:checked]:ring-4 has-[:checked]:ring-red-500/10">
                                    <input type="radio" name="disaster_status" value="Terjadi" required class="peer hidden">
                                    <div class="h-4 w-4 rounded-full border-2 border-slate-300 bg-white peer-checked:border-red-600 peer-checked:bg-red-500"></div>
                                    <span class="text-xs font-bold text-slate-600 peer-checked:text-red-700">Bencana Terjadi</span>
                                </label>

                                <label class="relative flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-3 transition hover:bg-white has-[:checked]:border-orange-700 has-[:checked]:bg-orange-50 has-[:checked]:ring-4 has-[:checked]:ring-orange-700/10">
                                    <input type="radio" name="prediction_percentage" value="80" class="peer hidden">
                                    <input type="hidden" name="disaster_status_val_1" value="Prediksi">
                                    <div class="h-4 w-4 rounded-full border-2 border-slate-300 bg-white peer-checked:border-orange-800 peer-checked:bg-orange-700"></div>
                                    <span class="text-xs font-bold text-slate-600 peer-checked:text-orange-900">Prediksi Sangat Tinggi (≥75%)</span>
                                </label>

                                <label class="relative flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-3 transition hover:bg-white has-[:checked]:border-orange-500 has-[:checked]:bg-orange-50 has-[:checked]:ring-4 has-[:checked]:ring-orange-500/10">
                                    <input type="radio" name="prediction_percentage" value="60" class="peer hidden">
                                    <div class="h-4 w-4 rounded-full border-2 border-slate-300 bg-white peer-checked:border-orange-600 peer-checked:bg-orange-500"></div>
                                    <span class="text-xs font-bold text-slate-600 peer-checked:text-orange-800">Prediksi Tinggi (50-74%)</span>
                                </label>

                                <label class="relative flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-3 transition hover:bg-white has-[:checked]:border-yellow-500 has-[:checked]:bg-yellow-50 has-[:checked]:ring-4 has-[:checked]:ring-yellow-500/10">
                                    <input type="radio" name="prediction_percentage" value="40" class="peer hidden">
                                    <div class="h-4 w-4 rounded-full border-2 border-slate-300 bg-white peer-checked:border-yellow-600 peer-checked:bg-yellow-500"></div>
                                    <span class="text-xs font-bold text-slate-600 peer-checked:text-yellow-800">Prediksi Sedang (30-49%)</span>
                                </label>

                                <label class="relative flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-3 transition hover:bg-white has-[:checked]:border-lime-500 has-[:checked]:bg-lime-50 has-[:checked]:ring-4 has-[:checked]:ring-lime-500/10">
                                    <input type="radio" name="prediction_percentage" value="20" class="peer hidden">
                                    <div class="h-4 w-4 rounded-full border-2 border-slate-300 bg-white peer-checked:border-lime-600 peer-checked:bg-lime-500"></div>
                                    <span class="text-xs font-bold text-slate-600 peer-checked:text-lime-800">Prediksi Rendah (<30%)</span>
                                </label>

                                <label class="relative flex cursor-pointer items-center gap-3 rounded-2xl border border-slate-200 bg-slate-50 p-3 transition hover:bg-white has-[:checked]:border-slate-400 has-[:checked]:bg-slate-100 has-[:checked]:ring-4 has-[:checked]:ring-slate-400/10">
                                    <input type="radio" name="disaster_status" value="Selesai" class="peer hidden">
                                    <div class="h-4 w-4 rounded-full border-2 border-slate-300 bg-white peer-checked:border-slate-500 peer-checked:bg-white shadow-inner"></div>
                                    <span class="text-xs font-bold text-slate-600 peer-checked:text-slate-900">Bencana Selesai</span>
                                </label>
                            </div>
                        </div>

                        <script>
                            // Script sederhana untuk mengatur disaster_status otomatis jika memilih prediksi
                            document.querySelectorAll('input[name="prediction_percentage"]').forEach(radio => {
                                radio.addEventListener('change', () => {
                                    const statusRadios = document.querySelectorAll('input[name="disaster_status"]');
                                    statusRadios.forEach(r => r.checked = false);
                                    
                                    // Buat hidden input jika belum ada untuk mengirim status "Prediksi"
                                    let hiddenStatus = document.getElementById('hidden_disaster_status');
                                    if(!hiddenStatus) {
                                        hiddenStatus = document.createElement('input');
                                        hiddenStatus.type = 'hidden';
                                        hiddenStatus.name = 'disaster_status';
                                        hiddenStatus.id = 'hidden_disaster_status';
                                        radio.form.appendChild(hiddenStatus);
                                    }
                                    hiddenStatus.value = 'Prediksi';
                                });
                            });

                            document.querySelectorAll('input[name="disaster_status"]').forEach(radio => {
                                radio.addEventListener('change', () => {
                                    document.querySelectorAll('input[name="prediction_percentage"]').forEach(r => r.checked = false);
                                    const hiddenStatus = document.getElementById('hidden_disaster_status');
                                    if(hiddenStatus) hiddenStatus.remove();
                                });
                            });
                        </script>
                        </div>

                        <div class="group space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-cyan-600">Sumber Informasi</label>
                            <input type="text" name="source" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10" value="BUMN">
                        </div>
                    </div>
                </div>

                <div class="mt-8 group space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-cyan-600">Deskripsi Kejadian</label>
                    <textarea name="description" rows="4" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-cyan-500 focus:bg-white focus:ring-4 focus:ring-cyan-500/10" placeholder="Jelaskan detail kejadian bencana..."></textarea>
                </div>

                <div class="mt-10 flex items-center justify-end gap-4 border-t border-slate-100 pt-8">
                    <a href="{{ route('admin.dashboard') }}" class="rounded-2xl px-8 py-3.5 text-sm font-bold text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">Batal</a>
                    <button type="submit" class="rounded-2xl bg-slate-900 px-10 py-3.5 text-sm font-bold text-white shadow-xl shadow-slate-200 transition hover:bg-slate-800 hover:shadow-slate-300 active:scale-95">
                        Publish Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
