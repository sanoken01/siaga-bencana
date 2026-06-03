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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900" style="font-family: 'Sora', sans-serif;">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 flex-col border-r border-slate-200 bg-slate-900 p-6 text-slate-100 lg:flex">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-300">Siaga Bencana</p>
                <h1 class="mt-2 text-2xl font-bold">Admin Panel</h1>
            </div>

            <nav class="mt-10 space-y-2 text-sm">
                <button onclick="switchTab('overview')" class="tab-btn active block w-full rounded-xl bg-cyan-500/20 px-4 py-3 font-semibold text-cyan-100 text-left transition hover:bg-slate-800">Dashboard</button>
                <button onclick="switchTab('bencana')" class="tab-btn block w-full rounded-xl px-4 py-3 text-slate-300 text-left transition hover:bg-slate-800 hover:text-white">Manajemen Bencana</button>
                <button onclick="switchTab('donasi')" class="tab-btn block w-full rounded-xl px-4 py-3 text-slate-300 text-left transition hover:bg-slate-800 hover:text-white">Manajemen Donasi</button>
                <button onclick="switchTab('laporan')" class="tab-btn block w-full rounded-xl px-4 py-3 text-slate-300 text-left transition hover:bg-slate-800 hover:text-white">Laporan Pengguna</button>
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
                <!-- TAB: OVERVIEW -->
                <section id="tab-overview" class="tab-content">
                    <div class="grid gap-4 md:grid-cols-4">
                        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <p class="text-sm text-slate-500">Total Laporan Bencana</p>
                            <h3 class="mt-2 text-3xl font-extrabold text-cyan-700">{{ $stats['total_reports'] }}</h3>
                        </article>

                        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <p class="text-sm text-slate-500">Total Donasi</p>
                            <h3 class="mt-2 text-3xl font-extrabold text-emerald-600">{{ $stats['total_donations'] }}</h3>
                        </article>

                        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <p class="text-sm text-slate-500">Total Pengguna</p>
                            <h3 class="mt-2 text-3xl font-extrabold text-rose-600">{{ $stats['total_users'] }}</h3>
                        </article>

                        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <p class="text-sm text-slate-500">Dana Terkumpul</p>
                            <h3 class="mt-2 text-2xl font-extrabold text-yellow-600">Rp {{ number_format($stats['total_funds'], 0, ',', '.') }}</h3>
                        </article>
                    </div>

                    <section class="mt-6 grid gap-4 xl:grid-cols-2">
                        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <h3 class="text-lg font-bold">Manajemen Data</h3>
                            <p class="mt-2 text-sm text-slate-600">Kelola data bencana, donasi, dan laporan dari satu panel terpusat.</p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <button onclick="switchTab('bencana')" class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-cyan-500">Data Bencana</button>
                                <button onclick="switchTab('donasi')" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-500">Data Donasi</button>
                                <button onclick="switchTab('laporan')" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-rose-500">Data Laporan</button>
                            </div>
                        </article>

                        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <h3 class="text-lg font-bold">Aktivitas Terkini</h3>
                            <ul class="mt-3 space-y-3 text-sm text-slate-600">
                                <li class="rounded-lg bg-slate-50 px-3 py-2">✓ {{ $reports->count() }} laporan bencana tercatat</li>
                                <li class="rounded-lg bg-slate-50 px-3 py-2">✓ {{ $donations->count() }} donasi diterima</li>
                                <li class="rounded-lg bg-slate-50 px-3 py-2">✓ {{ $users->count() }} pengguna terdaftar</li>
                            </ul>
                        </article>
                    </section>
                </section>

                <!-- TAB: DATA BENCANA -->
                <section id="tab-bencana" class="tab-content hidden">
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold">Manajemen Data Bencana</h2>
                        <p class="text-sm text-slate-600">Total: {{ $reports->count() }} laporan</p>
                    </div>

                    <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
                        <table class="w-full text-sm">
                            <thead class="border-b border-slate-200 bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Judul</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Lokasi</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Tipe</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Pengguna</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($reports as $report)
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-6 py-4 font-medium">{{ $report->title }}</td>
                                        <td class="px-6 py-4">{{ $report->location ?? '-' }}</td>
                                        <td class="px-6 py-4"><span class="rounded bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">{{ $report->type }}</span></td>
                                        <td class="px-6 py-4">{{ $report->user?->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-4 text-slate-600">{{ $report->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-slate-500">Tidak ada data bencana</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- TAB: DATA DONASI -->
                <section id="tab-donasi" class="tab-content hidden">
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold">Manajemen Donasi</h2>
                        <p class="text-sm text-slate-600">Total: {{ $donations->count() }} donasi | Dana: Rp {{ number_format($donations->sum('amount') ?? 0, 0, ',', '.') }}</p>
                    </div>

                    <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
                        <table class="w-full text-sm">
                            <thead class="border-b border-slate-200 bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Donatur</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Email</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Jumlah</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Metode</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($donations as $donation)
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-6 py-4 font-medium">{{ $donation->user?->name ?? $donation->name }}</td>
                                        <td class="px-6 py-4">{{ $donation->email }}</td>
                                        <td class="px-6 py-4 font-semibold text-green-600">Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4"><span class="rounded bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">{{ $donation->payment_method ?? '-' }}</span></td>
                                        <td class="px-6 py-4 text-slate-600">{{ $donation->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-slate-500">Tidak ada data donasi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- TAB: DATA LAPORAN PENGGUNA -->
                <section id="tab-laporan" class="tab-content hidden">
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold">Data Pengguna</h2>
                        <p class="text-sm text-slate-600">Total: {{ $users->count() }} pengguna</p>
                    </div>

                    <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
                        <table class="w-full text-sm">
                            <thead class="border-b border-slate-200 bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Nama</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Email</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Role</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Laporan</th>
                                    <th class="px-6 py-3 text-left font-semibold text-slate-700">Terdaftar</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($users as $user)
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                                        <td class="px-6 py-4">{{ $user->email }}</td>
                                        <td class="px-6 py-4">
                                            <span class="rounded px-3 py-1 text-xs font-semibold {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">{{ $user->reports->count() ?? 0 }}</td>
                                        <td class="px-6 py-4 text-slate-600">{{ $user->created_at->format('d M Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-slate-500">Tidak ada data pengguna</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide semua tab
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
            
            // Show tab yang dipilih
            const selectedTab = document.getElementById('tab-' + tabName);
            if (selectedTab) {
                selectedTab.classList.remove('hidden');
            }

            // Update button active state
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active', 'bg-cyan-500/20', 'text-cyan-100'));
            event.target.classList.add('active', 'bg-cyan-500/20', 'text-cyan-100');
        }
    </script>
</body>
</html>
