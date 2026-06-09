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
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body class="min-h-screen bg-slate-100 text-slate-900" style="font-family: 'Sora', sans-serif;">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 flex-col border-r border-slate-200 bg-slate-900 p-6 text-slate-100 lg:flex">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-300">Siaga Bencana</p>
                <h1 class="mt-2 text-2xl font-bold">Admin Panel</h1>
            </div>

            <nav class="mt-10 space-y-2 text-sm">
                <button onclick="switchTab('overview', this)" class="tab-btn active block w-full rounded-xl bg-cyan-500/20 px-4 py-3 font-semibold text-cyan-100 text-left transition hover:bg-slate-800">
                    <i class="fa-solid fa-chart-line mr-2"></i> Dashboard
                </button>
                <button onclick="switchTab('bencana', this)" class="tab-btn block w-full rounded-xl px-4 py-3 text-slate-300 text-left transition hover:bg-slate-800 hover:text-white">
                    <i class="fa-solid fa-house-fire mr-2"></i> Data Bencana
                </button>
                <button onclick="switchTab('donasi', this)" class="tab-btn block w-full rounded-xl px-4 py-3 text-slate-300 text-left transition hover:bg-slate-800 hover:text-white">
                    <i class="fa-solid fa-hand-holding-heart mr-2"></i> Data Donasi
                </button>
                <button onclick="switchTab('users', this)" class="tab-btn block w-full rounded-xl px-4 py-3 text-slate-300 text-left transition hover:bg-slate-800 hover:text-white">
                    <i class="fa-solid fa-users-gear mr-2"></i> Data Pengguna
                </button>
                <button onclick="switchTab('tracking', this)" class="tab-btn block w-full rounded-xl px-4 py-3 text-slate-300 text-left transition hover:bg-slate-800 hover:text-white">
                    <i class="fa-solid fa-history mr-2"></i> Pelacakan Donasi
                </button>
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

                    <a href="{{ route('logout.get') }}" class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                        Logout
                    </a>
                </div>
            </header>

            <main class="p-5 sm:p-8">
                @if(session('success'))
                    <div class="mb-4 rounded-xl bg-emerald-100 p-4 text-sm font-semibold text-emerald-700 shadow-sm">
                        <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 rounded-xl bg-rose-100 p-4 text-sm font-semibold text-rose-700 shadow-sm">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i> {{ session('error') }}
                    </div>
                @endif
                
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
                                <button onclick="switchTab('bencana', document.querySelectorAll('.tab-btn')[1])" class="rounded-lg bg-cyan-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-cyan-500">Data Bencana</button>
                                <button onclick="switchTab('donasi', document.querySelectorAll('.tab-btn')[2])" class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-500">Data Donasi</button>
                                <button onclick="switchTab('users', document.querySelectorAll('.tab-btn')[3])" class="rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-rose-500">Data Pengguna</button>
                            </div>
                        </article>

                        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                            <h3 class="text-lg font-bold">Aktivitas Terkini</h3>
                            <ul class="mt-3 space-y-3 text-sm text-slate-600">
                                <li class="rounded-lg bg-slate-50 px-3 py-2">✓ {{ $reports->total() }} laporan bencana tercatat</li>
                                <li class="rounded-lg bg-slate-50 px-3 py-2">✓ {{ $donations->total() }} donasi diterima</li>
                                <li class="rounded-lg bg-slate-50 px-3 py-2">✓ {{ $users->total() }} pengguna terdaftar</li>
                            </ul>
                        </article>
                    </section>
                </section>

                <!-- TAB: DATA BENCANA -->
                <section id="tab-bencana" class="tab-content hidden">
                    <div class="mb-6 flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-cyan-800">Manajemen Laporan Bencana</h2>
                            <p class="text-sm text-slate-600">Daftar semua laporan bencana yang masuk ke sistem.</p>
                        </div>
                        <a href="{{ route('admin.reports.create') }}" class="rounded-xl bg-cyan-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-cyan-200 transition hover:bg-cyan-700">
                            <i class="fa-solid fa-plus mr-2"></i> Tambah Laporan
                        </a>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @forelse($reports as $report)
                            <article class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                                @php
                                    $borderColor = 'bg-slate-400'; // Default Selesai
                                    if ($report->disaster_status === 'Terjadi') {
                                        $borderColor = 'bg-red-500';
                                    } elseif ($report->disaster_status === 'Prediksi') {
                                        if ($report->prediction_percentage >= 75) $borderColor = 'bg-orange-700';
                                        elseif ($report->prediction_percentage >= 50) $borderColor = 'bg-orange-500';
                                        elseif ($report->prediction_percentage >= 30) $borderColor = 'bg-yellow-500';
                                        else $borderColor = 'bg-lime-500';
                                    }
                                @endphp
                                <div class="absolute left-0 top-0 h-full w-1 {{ $borderColor }}"></div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="rounded bg-blue-100 px-2 py-0.5 text-[10px] font-bold text-blue-700 uppercase">
                                        {{ $report->disaster_type }}
                                    </span>
                                    <span class="text-[10px] font-bold uppercase tracking-wider {{ $report->is_confirmed ? 'text-green-600' : 'text-amber-600' }}">
                                        {{ $report->is_confirmed ? 'Dikonfirmasi' : 'Menunggu' }}
                                    </span>
                                </div>
                                <h4 class="font-bold text-slate-900 line-clamp-1">{{ $report->title }}</h4>
                                <div class="mt-2 flex items-center gap-1 text-xs text-slate-500">
                                    <i class="fa-solid fa-location-dot text-[10px]"></i>
                                    <span>{{ $report->location ?? '-' }}</span>
                                </div>
                                <div class="mt-4 flex items-center justify-between border-t border-slate-50 pt-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.reports.edit', $report) }}" class="rounded-lg bg-slate-100 p-2 text-slate-600 transition hover:bg-cyan-100 hover:text-cyan-700" title="Edit Laporan">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg bg-slate-100 p-2 text-slate-600 transition hover:bg-rose-100 hover:text-rose-700" title="Hapus Laporan">
                                                <i class="fa-solid fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @if(!$report->is_confirmed)
                                        <form action="{{ route('admin.reports.confirm', $report) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="rounded-lg bg-cyan-600 px-3 py-1.5 text-[10px] font-bold text-white transition hover:bg-cyan-700">
                                                Konfirmasi
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center text-slate-500">
                                Tidak ada data bencana.
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $reports->appends(['tab' => 'bencana'])->links() }}
                    </div>
                </section>

                <!-- TAB: DATA DONASI -->
                <section id="tab-donasi" class="tab-content hidden">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-emerald-700">Manajemen Donasi</h2>
                        <p class="text-sm text-slate-600">Daftar kontribusi masuk dari para relawan.</p>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @forelse($donations as $donation)
                            <article class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                                <div class="absolute left-0 top-0 h-full w-1 bg-emerald-500"></div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-[10px] font-bold text-emerald-700 uppercase tracking-wider">
                                        {{ $donation->payment_method ?? 'Transfer' }}
                                    </span>
                                    <span class="text-xs text-slate-400">{{ $donation->created_at->format('d M Y') }}</span>
                                </div>
                                <h4 class="font-bold text-slate-900">{{ $donation->donor_name }}</h4>
                                <p class="text-xs text-slate-500 mb-3">{{ $donation->email }}</p>
                                <div class="border-t border-slate-50 pt-3 mt-3">
                                    <p class="text-xs text-slate-400 mb-1 text-[10px] uppercase font-bold tracking-tight">Jumlah Donasi:</p>
                                    <p class="text-xl font-black text-emerald-600">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                                </div>
                                @if($donation->report)
                                    <div class="mt-3 flex items-center gap-2 rounded-lg bg-slate-50 p-2 text-[10px]">
                                        <i class="fa-solid fa-location-dot text-amber-500"></i>
                                        <span class="truncate font-medium text-slate-600">{{ $donation->report->title }}</span>
                                    </div>
                                @endif
                            </article>
                        @empty
                            <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center text-slate-500">
                                Tidak ada data donasi.
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $donations->appends(['tab' => 'donasi'])->links() }}
                    </div>
                </section>

                <!-- TAB: DATA PENGGUNA -->
                <section id="tab-users" class="tab-content hidden">
                    <div class="mb-6 flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-cyan-800">Manajemen Pengguna</h2>
                            <p class="text-sm text-slate-600">Daftar semua relawan dan administrator sistem.</p>
                        </div>
                        <a href="{{ route('admin.users.create') }}" class="rounded-xl bg-blue-600 px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-blue-200 transition hover:bg-blue-700">
                            <i class="fa-solid fa-user-plus mr-2"></i> Tambah User
                        </a>
                    </div>

                    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @forelse($users as $user)
                            <article class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                                <div class="absolute left-0 top-0 h-full w-1 {{ $user->role === 'admin' ? 'bg-rose-500' : 'bg-blue-500' }}"></div>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-500">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-900 leading-tight">{{ $user->name }}</h4>
                                        <span class="rounded px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider {{ $user->role === 'admin' ? 'bg-rose-100 text-rose-700' : 'bg-blue-100 text-blue-700' }}">
                                            {{ $user->role }}
                                        </span>
                                    </div>
                                </div>
                                <div class="space-y-2 border-t border-slate-50 pt-3">
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-400">Email:</span>
                                        <span class="font-medium text-slate-700 truncate max-w-[150px]">{{ $user->email }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-400">Laporan:</span>
                                        <span class="font-bold text-slate-900">{{ $user->reports->count() }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-400">Joined:</span>
                                        <span class="text-slate-500">{{ $user->created_at->format('M Y') }}</span>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center justify-end gap-2 border-t border-slate-50 pt-3">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="rounded-lg bg-slate-50 px-3 py-1.5 text-[10px] font-bold text-slate-600 transition hover:bg-blue-100 hover:text-blue-700">
                                        <i class="fa-solid fa-user-pen mr-1"></i> Edit
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini secara permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg bg-slate-50 px-3 py-1.5 text-[10px] font-bold text-slate-400 transition hover:bg-rose-100 hover:text-rose-700">
                                                <i class="fa-solid fa-user-minus mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center text-slate-500">
                                Tidak ada data pengguna.
                            </div>
                        @endforelse
                    </div>
                    <div class="mt-4">
                        {{ $users->appends(['tab' => 'users'])->links() }}
                    </div>
                </section>

                <!-- TAB: PELACAKAN DONASI -->
                <section id="tab-tracking" class="tab-content hidden">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-cyan-800">Pelacakan Donasi Terakhir</h2>
                        <p class="text-sm text-slate-600">Snapshot kontribusi terbaru dari setiap pengguna.</p>
                    </div>

                    <div class="space-y-4">
                        @forelse($trackingData as $user)
                            @php $lastDonation = $user->latestDonation; @endphp
                            <article class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                                <div class="absolute left-0 top-0 h-full w-1 bg-cyan-500"></div>
                                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                                    <div class="flex items-start gap-4">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-cyan-100 text-cyan-700">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-slate-900">{{ $user->name }}</h4>
                                            <p class="text-xs text-slate-500">{{ $user->email }}</p>
                                        </div>
                                    </div>

                                    <div class="flex-1 border-slate-100 md:border-l md:pl-8">
                                        <div class="flex items-center gap-2 text-sm">
                                            <span class="font-semibold text-slate-700">Donasi Terakhir:</span>
                                            <span class="font-bold text-emerald-600">Rp {{ number_format($lastDonation->amount, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="mt-1 flex items-center gap-2">
                                            <span class="text-xs text-slate-400">Target:</span>
                                            <span class="text-xs font-medium text-slate-700">{{ $lastDonation->report->title ?? '-' }}</span>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Pushed at:</p>
                                        <p class="text-sm font-bold text-slate-700">{{ $lastDonation->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center text-slate-500">
                                Belum ada data pelacakan.
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $trackingData->appends(['tab' => 'tracking'])->links() }}
                    </div>
                </section>
            </main>
        </div>
    </div>

    <script>
        function switchTab(tabName, btn) {
            // Hide semua tab
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
            
            // Show tab yang dipilih
            const selectedTab = document.getElementById('tab-' + tabName);
            if (selectedTab) {
                selectedTab.classList.remove('hidden');
            }

            // Update button active state
            document.querySelectorAll('.tab-btn').forEach(b => {
                b.classList.remove('active', 'bg-cyan-500/20', 'text-cyan-100');
                b.classList.add('text-slate-300');
            });
            
            if (btn) {
                btn.classList.add('active', 'bg-cyan-500/20', 'text-cyan-100');
                btn.classList.remove('text-slate-300');
            }
        }

        // Handle tab from URL on load
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            
            if (tab) {
                const tabBtnMap = {
                    'overview': 0,
                    'bencana': 1,
                    'donasi': 2,
                    'users': 3,
                    'tracking': 4
                };
                
                const btnIndex = tabBtnMap[tab];
                if (btnIndex !== undefined) {
                    const btns = document.querySelectorAll('.tab-btn');
                    if (btns[btnIndex]) {
                        switchTab(tab, btns[btnIndex]);
                    }
                }
            }
        });
    </script>
</body>
</html>
