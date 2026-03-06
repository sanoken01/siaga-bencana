<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard User | Siaga Bencana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900" style="font-family: 'Sora', sans-serif;">
    <header class="border-b border-slate-200 bg-white/90 backdrop-blur sticky top-0 z-20">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-5 py-4">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.25em] text-cyan-700">Siaga Bencana</p>
                <h1 class="text-lg font-bold">Dashboard Pengguna</h1>
            </div>

            <div class="flex items-center gap-3">
                <span class="hidden sm:inline text-sm text-slate-600">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="rounded-lg bg-slate-900 px-3.5 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-5 py-8">
        <section class="rounded-3xl border border-cyan-100 bg-gradient-to-r from-cyan-500 to-blue-600 p-7 text-white shadow-xl shadow-cyan-800/20">
            <h2 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}.</h2>
            <p class="mt-2 text-sm text-cyan-50">Selamat datang di pusat monitoring Siaga Bencana. Pantau informasi terbaru dan laporkan kondisi darurat lebih cepat.</p>
        </section>

        <section class="mt-6 grid gap-4 md:grid-cols-3">
            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <p class="text-sm text-slate-500">Status Akun</p>
                <h3 class="mt-2 text-xl font-bold text-slate-900">{{ ucfirst(Auth::user()->role) }}</h3>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <p class="text-sm text-slate-500">Laporan Saya</p>
                <h3 class="mt-2 text-xl font-bold text-slate-900">Akses Modul Laporan</h3>
            </article>

            <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <p class="text-sm text-slate-500">Respon Darurat</p>
                <h3 class="mt-2 text-xl font-bold text-slate-900">Aktif 24/7</h3>
            </article>
        </section>
    </main>
</body>
</html>
