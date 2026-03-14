<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Laporan Bencana</title>

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
            --bg-top: #f4faff;
            --bg-bottom: #e8f4ff;
            --card: rgba(255, 255, 255, 0.92);
            --line: rgba(80, 150, 230, 0.25);
            --line-focus: #4a9dff;
            --ink: #13304f;
            --muted: #667990;
            --danger: #dc2626;
            --blue-start: #4f99ff;
            --blue-end: #00b7ff;
            --shadow-soft: 0 20px 45px rgba(12, 76, 150, 0.16);
            --shadow-strong: 0 28px 55px rgba(12, 76, 150, 0.22);
            --radius-card: 16px;
            --radius-input: 12px;
            --transition: all 0.25s ease;
        }

        html,
        body {
            min-height: 100%;
            font-family: 'Poppins', sans-serif;
            color: var(--ink);
            background: linear-gradient(135deg, var(--bg-top) 0%, var(--bg-bottom) 100%);
        }

        body {
            position: relative;
            overflow-x: hidden;
        }

        .glow {
            position: fixed;
            border-radius: 999px;
            filter: blur(12px);
            pointer-events: none;
            z-index: -1;
            opacity: 0.55;
        }

        .glow.one {
            width: 280px;
            height: 280px;
            right: -90px;
            top: -70px;
            background: linear-gradient(140deg, rgba(79, 153, 255, 0.5), rgba(0, 183, 255, 0.25));
        }

        .glow.two {
            width: 260px;
            height: 260px;
            left: -80px;
            bottom: -100px;
            background: linear-gradient(140deg, rgba(0, 183, 255, 0.25), rgba(79, 153, 255, 0.45));
        }

        .page {
            width: min(800px, calc(100% - 30px));
            margin: 0 auto;
            padding: 64px 0 84px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            color: #185a9a;
            border: 1px solid var(--line);
            background: rgba(255, 255, 255, 0.82);
            border-radius: 999px;
            padding: 10px 16px;
            margin-bottom: 20px;
            transition: var(--transition);
            box-shadow: 0 12px 24px rgba(12, 76, 150, 0.12);
        }

        .back-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 26px rgba(12, 76, 150, 0.17);
        }

        .form-card {
            background: var(--card);
            border: 1px solid rgba(255, 255, 255, 0.85);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-soft);
            transition: var(--transition);
            overflow: hidden;
        }

        .form-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-strong);
        }

        .card-header {
            padding: 28px 30px 18px;
            border-bottom: 1px solid rgba(80, 150, 230, 0.16);
            background: linear-gradient(120deg, rgba(79, 153, 255, 0.1), rgba(0, 183, 255, 0.08));
        }

        .page-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: clamp(1.5rem, 3.2vw, 2rem);
            line-height: 1.2;
            color: #0f3a67;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .page-subtitle {
            color: var(--muted);
            line-height: 1.65;
            font-size: 0.95rem;
        }

        .card-body {
            padding: 26px 30px 30px;
        }

        .form-grid {
            display: grid;
            gap: 16px;
        }

        .field {
            display: grid;
            gap: 7px;
        }

        .field-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: #20496f;
        }

        .input,
        .select,
        .textarea {
            width: 100%;
            border: 1px solid var(--line);
            background: #ffffff;
            border-radius: var(--radius-input);
            color: #1d3f62;
            font: inherit;
            transition: var(--transition);
        }

        .input,
        .select {
            min-height: 48px;
            padding: 0 14px;
        }

        .textarea {
            min-height: 150px;
            resize: vertical;
            padding: 12px 14px;
            line-height: 1.6;
        }

        .input:hover,
        .select:hover,
        .textarea:hover {
            border-color: rgba(74, 157, 255, 0.65);
        }

        .input:focus,
        .select:focus,
        .textarea:focus {
            outline: none;
            border-color: var(--line-focus);
            box-shadow: 0 0 0 4px rgba(79, 153, 255, 0.16);
            transform: translateY(-1px);
        }

        .error-text {
            color: var(--danger);
            font-size: 0.82rem;
            font-weight: 500;
            min-height: 18px;
        }

        .button-row {
            margin-top: 6px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 50px;
            padding: 0 20px;
            border-radius: 12px;
            font: inherit;
            font-size: 0.94rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-update {
            flex: 1 1 260px;
            color: #fff;
            background: linear-gradient(120deg, var(--blue-start), var(--blue-end));
            box-shadow: 0 16px 30px rgba(0, 124, 219, 0.34);
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 24px 36px rgba(0, 124, 219, 0.42);
            filter: brightness(1.03);
        }

        .btn-back {
            flex: 0 1 210px;
            color: #47617c;
            border: 1px solid rgba(95, 116, 138, 0.38);
            background: #fff;
            box-shadow: 0 10px 20px rgba(13, 63, 120, 0.09);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            border-color: rgba(74, 157, 255, 0.65);
            color: #21507e;
            box-shadow: 0 15px 24px rgba(13, 63, 120, 0.14);
        }

        @media (max-width: 900px) {
            .page {
                width: min(760px, calc(100% - 28px));
                padding-top: 56px;
            }
        }

        @media (max-width: 700px) {
            .card-header,
            .card-body {
                padding-inline: 20px;
            }

            .button-row {
                flex-direction: column;
            }

            .btn-update,
            .btn-back {
                width: 100%;
                flex: 1 1 auto;
            }
        }

        @media (max-width: 430px) {
            .page {
                width: calc(100% - 20px);
            }

            .back-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="glow one"></div>
    <div class="glow two"></div>

    <main class="page">
        <a href="{{ route('reports.index') }}" class="back-link">
            <span>←</span>
            <span>Kembali ke daftar laporan</span>
        </a>

        <section class="form-card" aria-label="Form edit laporan bencana">
            <header class="card-header">
                <h1 class="page-title">
                    <span aria-hidden="true">🛡️</span>
                    <span>Edit Laporan Bencana</span>
                </h1>
                <p class="page-subtitle">Perbarui informasi laporan bencana yang telah dikirim.</p>
            </header>

            <div class="card-body">
                <form action="{{ route('reports.update', $report->id) }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <div class="field">
                            <label for="title" class="field-label">📝 Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="input"
                                value="{{ old('title', $report->title) }}"
                                placeholder="Contoh: Banjir di sekitar sekolah"
                                required
                            >
                            <p class="error-text">@error('title') {{ $message }} @enderror</p>
                        </div>

                        <div class="field">
                            <label for="disaster_type" class="field-label">🌍 Disaster Type</label>
                            <select id="disaster_type" name="disaster_type" class="select" required>
                                <option value="">Pilih jenis bencana</option>
                                <option value="Gempa" {{ old('disaster_type', $report->disaster_type) === 'Gempa' ? 'selected' : '' }}>🌍 Gempa</option>
                                <option value="Banjir" {{ old('disaster_type', $report->disaster_type) === 'Banjir' ? 'selected' : '' }}>🌊 Banjir</option>
                                <option value="Longsor" {{ old('disaster_type', $report->disaster_type) === 'Longsor' ? 'selected' : '' }}>⛰ Longsor</option>
                                <option value="Angin Kencang" {{ old('disaster_type', $report->disaster_type) === 'Angin Kencang' ? 'selected' : '' }}>🌪 Angin Kencang</option>
                            </select>
                            <p class="error-text">@error('disaster_type') {{ $message }} @enderror</p>
                        </div>

                        <div class="field">
                            <label for="location" class="field-label">📍 Location</label>
                            <input
                                type="text"
                                id="location"
                                name="location"
                                class="input"
                                value="{{ old('location', $report->location) }}"
                                placeholder="Contoh: Surabaya, Jawa Timur"
                                required
                            >
                            <p class="error-text">@error('location') {{ $message }} @enderror</p>
                        </div>

                        <div class="field">
                            <label for="report_date" class="field-label">📅 Report Date</label>
                            <input
                                type="date"
                                id="report_date"
                                name="report_date"
                                class="input"
                                value="{{ old('report_date', \Illuminate\Support\Carbon::parse($report->report_date)->toDateString()) }}"
                                required
                            >
                            <p class="error-text">@error('report_date') {{ $message }} @enderror</p>
                        </div>

                        <div class="field">
                            <label for="description" class="field-label">📄 Description</label>
                            <textarea
                                id="description"
                                name="description"
                                class="textarea"
                                placeholder="Jelaskan kondisi bencana yang terjadi dan dampaknya."
                                required
                            >{{ old('description', $report->description) }}</textarea>
                            <p class="error-text">@error('description') {{ $message }} @enderror</p>
                        </div>

                        @php
                            $currentStatus = old('status', $report->status);
                            $statusKey = match (true) {
                                str_contains(strtolower($currentStatus), 'pending') || str_contains(strtolower($currentStatus), 'proses') => 'Diproses',
                                str_contains(strtolower($currentStatus), 'verified') || str_contains(strtolower($currentStatus), 'verifikasi') => 'Diverifikasi',
                                default => 'Selesai',
                            };
                        @endphp

                        <div class="field">
                            <label for="disaster_status" class="field-label">⚠ Status Bencana</label>
                            <select id="disaster_status" name="disaster_status" class="select">
                                <option value="Terjadi" {{ old('disaster_status', $report->disaster_status) === 'Terjadi' ? 'selected' : '' }}>Terjadi</option>
                                <option value="Prediksi" {{ old('disaster_status', $report->disaster_status) === 'Prediksi' ? 'selected' : '' }}>Prediksi</option>
                                <option value="Selesai" {{ old('disaster_status', $report->disaster_status) === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            <p class="error-text">@error('disaster_status') {{ $message }} @enderror</p>
                        </div>

                        <div class="button-row">
                            <button type="submit" class="btn btn-update">Update Report</button>
                            <a href="{{ route('reports.index') }}" class="btn btn-back">Kembali ke Laporan</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
