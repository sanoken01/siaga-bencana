<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Laporan Bencana - Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Sora', sans-serif; }
        .table-container { overflow-x: auto; }
        .badge { display: inline-block; padding: 0.3rem 0.6rem; border-radius: 6px; font-size: 0.8rem; font-weight: 600; }
        .badge-completed { background: #10b981; color: white; }
        .badge-ongoing { background: #f59e0b; color: white; }
        .progress-bar { background: #e5e7eb; border-radius: 999px; height: 6px; overflow: hidden; }
        .progress-fill { background: #3b82f6; height: 100%; border-radius: 999px; }
        .modal { position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; z-index: 50; }
        .modal.active { display: flex; }
        .modal-content { background: white; border-radius: 12px; padding: 2rem; max-width: 500px; width: 90%; }
        input, select { width: 100%; border: 1px solid #d1d5db; border-radius: 8px; padding: 0.5rem; margin: 0.5rem 0; font: inherit; }
        button { padding: 0.5rem 1rem; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; }
        .btn-primary { background: #3b82f6; color: white; }
        .btn-primary:hover { background: #2563eb; }
        .btn-danger { background: #ef4444; color: white; }
        .btn-danger:hover { background: #dc2626; }
    </style>
</head>
<body class="min-h-screen bg-slate-100">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 flex-col border-r border-slate-200 bg-slate-900 p-6 text-slate-100 lg:flex">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-cyan-300">Siaga Bencana</p>
                <h1 class="mt-2 text-2xl font-bold">Admin Panel</h1>
            </div>

            <nav class="mt-10 space-y-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800">Dashboard</a>
                <a href="{{ route('admin.reports') }}" class="block rounded-xl bg-cyan-500/20 px-4 py-3 font-semibold text-cyan-100">Manajemen Laporan Bencana</a>
                <a href="#" class="block rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800">Manajemen Pengguna</a>
                <a href="#" class="block rounded-xl px-4 py-3 text-slate-300 transition hover:bg-slate-800">Donasi & Verifikasi</a>
            </nav>

            <div class="mt-auto text-xs text-slate-400">Role: {{ ucfirst(Auth::user()->role) }}</div>
        </aside>

        <div class="flex-1">
            <header class="border-b border-slate-200 bg-white px-5 py-4 shadow-sm sm:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold">Manajemen Laporan Bencana</h2>
                        <p class="text-sm text-slate-500">Kelola semua laporan bencana dan target donasi.</p>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-700">Logout</button>
                    </form>
                </div>
            </header>

            <main class="p-5 sm:p-8">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-lg font-bold">Daftar Laporan</h3>
                    <a href="{{ route('reports.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Laporan</a>
                </div>

                @if ($reports->count() > 0)
                    <div class="table-container rounded-lg border border-slate-200 bg-white shadow-sm overflow-hidden">
                        <table class="w-full text-sm">
                            <thead class="border-b border-slate-200 bg-slate-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold">Judul</th>
                                    <th class="px-4 py-3 text-left font-semibold">Lokasi</th>
                                    <th class="px-4 py-3 text-left font-semibold">Status</th>
                                    <th class="px-4 py-3 text-left font-semibold">Target Donasi</th>
                                    <th class="px-4 py-3 text-left font-semibold">Progress</th>
                                    <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    @php
                                        $collected = $report->getTotalDonations();
                                        $goal = $report->goal_amount ?? 1000000;
                                        $percentage = $report->getDonationPercentage();
                                        $status = $report->disaster_status ?? 'Prediksi';
                                        $badgeClass = $status === 'Selesai' ? 'badge-completed' : 'badge-ongoing';
                                    @endphp
                                    <tr class="border-b border-slate-100 hover:bg-slate-50">
                                        <td class="px-4 py-3">
                                            <p class="font-semibold">{{ $report->title }}</p>
                                            <p class="text-xs text-slate-500">{{ $report->disaster_type }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600">{{ $report->location }}</td>
                                        <td class="px-4 py-3">
                                            <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <p class="font-semibold">Rp {{ number_format($goal, 0, ',', '.') }}</p>
                                            <p class="text-xs text-slate-500">Terkumpul: Rp {{ number_format($collected, 0, ',', '.') }}</p>
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: {{ $percentage }}%;"></div>
                                            </div>
                                            <p class="text-xs text-slate-600 mt-1">{{ round($percentage, 1) }}%</p>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <button class="btn btn-primary text-xs" onclick="openEditModal({{ $report->id }}, '{{ addslashes($report->title) }}', {{ $goal }})">Edit Goal</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="rounded-lg border border-slate-200 bg-white p-8 text-center">
                        <p class="text-slate-500">Belum ada laporan bencana.</p>
                    </div>
                @endif
            </main>
        </div>
    </div>

    <div class="modal" id="editGoalModal">
        <div class="modal-content">
            <h3 class="text-lg font-bold mb-4">Edit Target Donasi</h3>
            <form id="editGoalForm" method="POST">
                @csrf
                @method('PATCH')
                <div>
                    <label>Judl Laporan</label>
                    <p id="reportTitle" class="font-semibold text-slate-700 mt-2"></p>
                </div>
                <div>
                    <label for="goalAmount">Target Donasi (Rp)</label>
                    <input type="number" id="goalAmount" name="goal_amount" min="100000" step="100000" required>
                </div>
                <div class="flex gap-2 mt-6">
                    <button type="button" class="flex-1 btn btn-primary" onclick="submitEditGoal()">Simpan</button>
                    <button type="button" class="flex-1 btn" style="background: #e5e7eb; color: #374151;" onclick="closeEditModal()">Batal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentReportId = null;
        
        function openEditModal(reportId, title, goalAmount) {
            currentReportId = reportId;
            document.getElementById('reportTitle').textContent = title;
            document.getElementById('goalAmount').value = goalAmount;
            document.getElementById('editGoalForm').action = `/admin/reports/${reportId}/goal`;
            document.getElementById('editGoalModal').classList.add('active');
        }
        
        function closeEditModal() {
            document.getElementById('editGoalModal').classList.remove('active');
            currentReportId = null;
        }
        
        function submitEditGoal() {
            document.getElementById('editGoalForm').submit();
        }
    </script>
</body>
</html>
