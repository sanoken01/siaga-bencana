<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Laporan Bencana</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg-1: #f4faff;
            --bg-2: #eaf6ff;
            --ink: #13243f;
            --muted: #64748b;
            --blue-start: #4facfe;
            --blue-end: #00c6ff;
            --line: rgba(79, 172, 254, 0.22);
            --surface: rgba(255, 255, 255, 0.92);
            --surface-soft: rgba(255, 255, 255, 0.72);
            --pending: #f59e0b;
            --verified: #16a34a;
            --danger: #ef4444;
            --shadow-soft: 0 14px 30px rgba(15, 74, 156, 0.12);
            --shadow-hover: 0 24px 42px rgba(15, 74, 156, 0.2);
            --radius-xl: 22px;
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-pill: 999px;
            --transition: all 0.28s ease;
        }

        html,
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100%;
            color: var(--ink);
            background: #ffffff; /* simpler neutral background */
            scroll-behavior: smooth;
        }

        body {
            position: relative;
            overflow-x: hidden;
        }

        /* hide decorative blobs for a cleaner look */
        .blob { display: none; }

        .page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 48px 18px 80px;
        }

        .topbar {
            margin-bottom: 26px;
        }

        .topbar a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            border-radius: var(--radius-pill);
            border: 1px solid var(--line);
            background: #ffffff;
            color: #145ea8;
            padding: 10px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: 0 10px 20px rgba(15, 74, 156, 0.12);
        }

        .topbar a:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 24px rgba(15, 74, 156, 0.18);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            gap: 18px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }

        .title {
            font-size: clamp(1.75rem, 3.8vw, 2.7rem);
            line-height: 1.15;
            color: #0d3567;
            margin-bottom: 10px;
        }

        .subtitle {
            color: var(--muted);
            max-width: 700px;
            line-height: 1.7;
            font-size: 0.98rem;
        }

        .btn-create {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 48px;
            padding: 0 20px;
            border-radius: 14px;
            color: #fff;
            font-weight: 600;
            background: linear-gradient(120deg, var(--blue-start), var(--blue-end));
            box-shadow: 0 14px 28px rgba(8, 125, 225, 0.34);
            transition: var(--transition);
        }

        .btn-create:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 20px 34px rgba(8, 125, 225, 0.4);
        }

        .flash-success {
            margin-bottom: 20px;
            border-radius: 12px;
            background: rgba(22, 163, 74, 0.12);
            border: 1px solid rgba(22, 163, 74, 0.2);
            color: #166534;
            padding: 12px 14px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: opacity 0.28s ease, transform 0.28s ease;
        }

        .flash-success.is-hiding {
            opacity: 0;
            transform: translateY(-6px);
        }

        .report-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .report-card {
            background: #ffffff;
            border: 1px solid rgba(15, 74, 156, 0.06);
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(15, 74, 156, 0.06);
            padding: 22px;
            display: flex;
            flex-direction: column;
            gap: 14px;
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }

        .report-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(15, 74, 156, 0.12);
        }

        .report-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
        }

        .disaster-icon {
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            background: linear-gradient(135deg, var(--blue-start), var(--blue-end));
            color: #fff;
            box-shadow: 0 8px 20px rgba(79, 172, 254, 0.12);
            flex-shrink: 0;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            font-weight: 700;
            padding: 6px 10px;
            color: #fff;
            white-space: nowrap;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }

        .status-pending {
            background: var(--pending);
            box-shadow: 0 8px 14px rgba(245, 158, 11, 0.3);
        }

        .status-verified {
            background: var(--verified);
            box-shadow: 0 8px 14px rgba(22, 163, 74, 0.26);
        }

        .status-danger {
            background: var(--danger);
            box-shadow: 0 8px 14px rgba(239, 68, 68, 0.3);
        }

        .report-title {
            font-size: 1.12rem;
            font-weight: 800;
            color: #0d335f;
            line-height: 1.3;
            margin-bottom: 6px;
        }

        .report-desc {
            color: #4a5f78;
            font-size: 0.92rem;
            line-height: 1.45;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-top: 4px;
        }

        .report-details {
            border-radius: 10px;
            border: 1px solid rgba(15, 74, 156, 0.06);
            background: #fbfdff;
            padding: 10px;
        }

        .meta-list {
            list-style: none;
            display: grid;
            gap: 8px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            border-radius: 6px;
            border: none; /* remove inner boxed look */
            background: transparent;
            padding: 6px 0;
        }

        .meta-label {
            color: #5f708b;
            font-size: 0.79rem;
            font-weight: 600;
        }

        .meta-value {
            color: #1b3658;
            font-size: 0.84rem;
            font-weight: 500;
            text-align: right;
        }

        .action-row {
            margin-top: auto;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .btn-action {
            flex: 1;
            text-decoration: none;
            border: none;
            cursor: pointer;
            min-height: 44px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.92rem;
            font-weight: 700;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-edit {
            background: linear-gradient(90deg, var(--blue-start), var(--blue-end));
            border: 1px solid rgba(47, 143, 223, 0.18);
            color: #ffffff;
            box-shadow: 0 8px 20px rgba(47, 143, 223, 0.12);
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            background: #1f7cca;
            border-color: #1f7cca;
        }

        .btn-donate {
            background: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.15);
            color: #ffffff;
            box-shadow: 0 8px 18px rgba(16, 185, 129, 0.12);
        }

        .btn-donate:hover {
            transform: translateY(-2px);
            background: #059669;
            border-color: #059669;
        }

        .btn-delete {
            background: #ef4444;
            border: 1px solid #ef4444;
            color: #fff;
            box-shadow: 0 10px 20px rgba(239, 68, 68, 0.16);
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            background: #dc2626;
            border-color: #dc2626;
            color: #fff;
            box-shadow: 0 12px 22px rgba(220, 38, 38, 0.18);
        }

        .delete-form {
            flex: 1 1 0;
            display: flex;
        }

        .delete-form .btn-action {
            width: 100%;
            flex: 1 1 0;
        }

        .confirm-overlay {
            position: fixed;
            inset: 0;
            background: rgba(7, 24, 45, 0.58);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.28s ease, visibility 0.28s ease;
        }

        .confirm-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .confirm-modal {
            width: min(100%, 430px);
            border-radius: 16px;
            background: #fff;
            border: 1px solid rgba(13, 37, 63, 0.06);
            box-shadow: 0 30px 60px rgba(8, 30, 63, 0.18);
            padding: 24px;
            transform: translateY(14px) scale(0.98);
            transition: transform 0.28s ease;
        }

        .confirm-overlay.active .confirm-modal {
            transform: translateY(0) scale(1);
        }

        .confirm-title {
            font-size: 1.2rem;
            color: #b91c1c;
            margin-bottom: 8px;
            font-weight: 800;
        }

        .confirm-text {
            color: #1f2d3d;
            line-height: 1.5;
            font-size: 0.95rem;
            margin-bottom: 18px;
            font-weight: 600;
        }

        .confirm-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-modal {
            min-height: 42px;
            padding: 0 14px;
            border-radius: 10px;
            border: 1px solid transparent;
            background: transparent;
            font: inherit;
            font-size: 0.87rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-cancel {
            color: #465a73;
            border-color: rgba(100, 116, 139, 0.45);
            background: #fff;
        }

        .btn-cancel:hover {
            transform: translateY(-1px);
            border-color: rgba(100, 116, 139, 0.72);
        }

        .btn-confirm-delete {
            color: #fff;
            background: #dc2626;
            border-color: #dc2626;
            box-shadow: 0 10px 20px rgba(220, 38, 38, 0.3);
        }

        .btn-confirm-delete:hover {
            transform: translateY(-1px);
            background: #b91c1c;
            border-color: #b91c1c;
        }

        .empty-state {
            border-radius: var(--radius-xl);
            background: var(--surface);
            border: 1px solid rgba(255, 255, 255, 0.85);
            box-shadow: var(--shadow-soft);
            min-height: 320px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            gap: 14px;
            padding: 30px 20px;
        }

        .empty-icon {
            font-size: 3.3rem;
            line-height: 1;
        }

        .empty-text {
            font-size: 1.1rem;
            color: #3a4f6b;
            font-weight: 600;
        }

        @media (max-width: 992px) {
            .report-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .page {
                padding-top: 56px;
            }

            .header {
                align-items: flex-start;
            }

            .btn-create {
                width: 100%;
            }

            .report-grid {
                grid-template-columns: 1fr;
            }

            .action-row {
                flex-direction: column;
            }

            .confirm-actions {
                flex-direction: column;
            }

            .btn-modal {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="blob one"></div>
    <div class="blob two"></div>

    <main class="page">
        <nav class="topbar" aria-label="Kembali ke Landing Page">
            <a href="{{ url('/') }}">&larr; Kembali Ke Beranda</a>
        </nav>

        <header class="header">
            <div>
                <h1 class="title">Daftar Laporan Bencana</h1>
                <p class="subtitle">Pantau laporan bencana terbaru dari masyarakat di wilayah Jawa Timur.</p>
            </div>
            <a href="/reports/create" class="btn-create">+ Laporkan Bencana</a>
        </header>

        @if (session('success'))
            <div class="flash-success" id="flashSuccess">{{ session('success') }}</div>
        @endif

        @if ($reports->count() > 0)
            <section class="report-grid" aria-label="Daftar kartu laporan bencana">
                @foreach ($reports as $report)
                    @php
                        $typeLabel = strtolower($report->disaster_type);

                        $disasterIcon = match (true) {
                            str_contains($typeLabel, 'gempa') => '🌍',
                            str_contains($typeLabel, 'banjir') => '🌊',
                            str_contains($typeLabel, 'longsor') => '⛰',
                            str_contains($typeLabel, 'angin') => '🌪',
                            default => '⚠',
                        };

                        $disasterStatus = $report->disaster_status ?? 'Prediksi';
                        if ($disasterStatus === 'Terjadi') {
                            $statusClass = 'status-danger';
                            $statusLabel = 'Terjadi';
                        } elseif ($disasterStatus === 'Selesai') {
                            $statusClass = 'status-verified';
                            $statusLabel = 'Selesai';
                        } else {
                            $statusClass = 'status-pending';
                            $statusLabel = 'Prediksi';
                        }
                    @endphp

                    <article class="report-card">
                        <div class="report-head">
                            <div style="display:flex; gap:12px; align-items:flex-start;">
                                <span class="disaster-icon" aria-hidden="true">{{ $disasterIcon }}</span>
                                <div>
                                    <h2 class="report-title">{{ $report->title }}</h2>
                                    <p class="report-desc">{{ $report->description }}</p>
                                </div>
                            </div>
                            <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                        </div>

                        <div class="report-details">
                            <ul class="meta-list">
                                <li class="meta-item">
                                    <span class="meta-label">Jenis Bencana</span>
                                    <span class="meta-value">{{ $report->disaster_type }}</span>
                                </li>
                                <li class="meta-item">
                                    <span class="meta-label">Lokasi</span>
                                    <span class="meta-value">{{ $report->location }}</span>
                                </li>
                                <li class="meta-item">
                                    <span class="meta-label">Tanggal</span>
                                    <span class="meta-value">{{ \Carbon\Carbon::parse($report->report_date)->translatedFormat('d M Y') }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="action-row">
                            <a href="{{ route('reports.edit', $report->id) }}" class="btn-action btn-edit">Edit</a>

                            @if (($report->disaster_status ?? '') === 'Selesai')
                                <a href="{{ route('reports.donate', $report->id) }}" class="btn-action btn-donate">Donasi</a>
                            @endif

                            <form class="delete-form" action="{{ route('reports.destroy', $report->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-action btn-delete" data-delete-trigger>Delete</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </section>
        @else
            <section class="empty-state" aria-label="Belum ada laporan">
                <div class="empty-icon">⚠</div>
                <p class="empty-text">Belum ada laporan bencana.</p>
                <a href="/reports/create" class="btn-create">Buat laporan pertama</a>
            </section>
        @endif
    </main>

    <div class="confirm-overlay" id="deleteConfirmModal" aria-hidden="true">
        <div class="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle" aria-describedby="deleteModalMessage">
            <h2 class="confirm-title" id="deleteModalTitle">Hapus Laporan?</h2>
            <p class="confirm-text" id="deleteModalMessage">
                Apakah Anda yakin ingin menghapus laporan bencana ini? Tindakan ini tidak dapat dibatalkan.
            </p>
            <div class="confirm-actions">
                <button type="button" class="btn-modal btn-cancel" id="cancelDeleteBtn">Cancel</button>
                <button type="button" class="btn-modal btn-confirm-delete" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('deleteConfirmModal');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const deleteTriggers = document.querySelectorAll('[data-delete-trigger]');
        const flashSuccess = document.getElementById('flashSuccess');
        let activeDeleteForm = null;

        function openDeleteModal(form) {
            activeDeleteForm = form;
            modal.classList.add('active');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            modal.classList.remove('active');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            activeDeleteForm = null;
        }

        deleteTriggers.forEach((button) => {
            button.addEventListener('click', () => {
                openDeleteModal(button.closest('form'));
            });
        });

        cancelDeleteBtn.addEventListener('click', closeDeleteModal);

        confirmDeleteBtn.addEventListener('click', () => {
            if (activeDeleteForm) {
                activeDeleteForm.submit();
            }
        });

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeDeleteModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && modal.classList.contains('active')) {
                closeDeleteModal();
            }
        });

        if (flashSuccess) {
            window.setTimeout(() => {
                flashSuccess.classList.add('is-hiding');

                window.setTimeout(() => {
                    flashSuccess.remove();
                }, 280);
            }, 3000);
        }
    </script>
</body>
</html>
