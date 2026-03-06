<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard | Siaga Bencana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-900" style="font-family: 'Sora', sans-serif;">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 flex-col border-r border-slate-200 bg-slate-900 p-6 text-slate-100 lg:flex">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-300">Siaga Bencana</p>
                <h1 class="mt-2 text-2xl font-bold">Admin Panel</h1>
            </div>

            <nav class="mt-10 space-y-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block rounded-xl bg-cyan-500/20 px-4 py-3 font-semibold text-cyan-100">Dashboard</a>
                <a href="#" class="block rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">Manajemen Data Bencana</a>
                <a href="#" class="block rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">Manajemen Pengguna</a>
                <a href="#" class="block rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800 hover:text-white">Laporan & Verifikasi</a>
            </nav>

            <div class="mt-auto text-xs text-slate-400">Role: {{ ucfirst(Auth::user()->role) }}</div>
        </aside>

        <div class="flex-1">
            <header class="border-b border-slate-200 bg-white/90 px-5 py-4 backdrop-blur sm:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold">Dashboard Admin</h2>
                        <p class="text-sm text-slate-500">Kontrol pusat untuk statistik dan manajemen data Siaga Bencana.</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="p-5 sm:p-8">
                <section class="grid gap-4 md:grid-cols-3">
                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="text-sm text-slate-500">Total Laporan Hari Ini</p>
                        <h3 class="mt-2 text-3xl font-extrabold text-cyan-700">128</h3>
                    </article>

                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="text-sm text-slate-500">Laporan Diverifikasi</p>
                        <h3 class="mt-2 text-3xl font-extrabold text-emerald-600">94</h3>
                    </article>

                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="text-sm text-slate-500">Lokasi Prioritas Tinggi</p>
                        <h3 class="mt-2 text-3xl font-extrabold text-rose-600">17</h3>
                    </article>
                </section>

                <section class="mt-6 grid gap-4 xl:grid-cols-2">
                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <h3 class="text-lg font-bold">Manajemen Data</h3>
                        <p class="mt-2 text-sm text-slate-600">Kelola data bencana, relawan, dan verifikasi laporan dari satu panel terpusat.</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <button class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-cyan-500">Tambah Data</button>
                            <button class="rounded-lg bg-slate-800 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">Kelola Laporan</button>
                        </div>
                    </article>

                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <h3 class="text-lg font-bold">Aktivitas Terkini</h3>
                        <ul class="mt-3 space-y-3 text-sm text-slate-600">
                            <li class="rounded-lg bg-slate-50 px-3 py-2">Verifikasi laporan banjir - Bandung.</li>
                            <li class="rounded-lg bg-slate-50 px-3 py-2">Update status gempa - Sulawesi.</li>
                            <li class="rounded-lg bg-slate-50 px-3 py-2">Koordinasi relawan - Yogyakarta.</li>
                        </ul>
                    </article>
                </section>
            </main>
        </div>
    </div>
</body>
</html>
