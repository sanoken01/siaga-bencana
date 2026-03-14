<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan Bencana</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --blue-start: #4facfe;
            --blue-end: #00c6ff;
            --blue-deep: #0e4d99;
            --ink: #11243f;
            --muted: #5f708b;
            --surface: rgba(255, 255, 255, 0.8);
            --surface-strong: rgba(255, 255, 255, 0.94);
            --line: rgba(79, 172, 254, 0.28);
            --line-soft: rgba(79, 172, 254, 0.15);
            --danger: #e11d48;
            --shadow-soft: 0 22px 44px rgba(15, 74, 156, 0.16);
            --shadow-strong: 0 28px 60px rgba(15, 74, 156, 0.24);
            --radius-xl: 24px;
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-pill: 999px;
            --transition: all 0.28s ease;
        }

        html,
        body {
            min-height: 100%;
            font-family: 'Poppins', sans-serif;
            color: var(--ink);
            background: linear-gradient(135deg, #f6fbff 0%, #edf8ff 40%, #e8f5ff 100%);
        }

        body {
            position: relative;
            overflow-x: hidden;
        }

        .bg-blob {
            position: fixed;
            border-radius: 50%;
            z-index: -1;
            filter: blur(16px);
            pointer-events: none;
            opacity: 0.62;
        }

        .bg-blob.one {
            width: 330px;
            height: 330px;
            top: -80px;
            right: -90px;
            background: linear-gradient(130deg, rgba(79, 172, 254, 0.56), rgba(0, 198, 255, 0.35));
            animation: drift 9s ease-in-out infinite;
        }

        .bg-blob.two {
            width: 280px;
            height: 280px;
            bottom: -80px;
            left: -90px;
            background: linear-gradient(130deg, rgba(0, 198, 255, 0.38), rgba(79, 172, 254, 0.5));
            animation: drift 11s ease-in-out infinite reverse;
        }

        .page-wrapper {
            width: min(860px, 92%);
            margin: 0 auto;
            padding: 72px 0 90px;
        }

        .mini-navbar {
            margin-bottom: 24px;
            animation: fadeInUp 0.45s ease both;
        }

        .mini-nav-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            border-radius: var(--radius-pill);
            border: 1px solid var(--line);
            background: var(--surface);
            color: var(--blue-deep);
            text-decoration: none;
            font-size: 0.93rem;
            font-weight: 500;
            box-shadow: 0 12px 24px rgba(15, 74, 156, 0.14);
            backdrop-filter: blur(10px);
            transition: var(--transition);
        }

        .mini-nav-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 28px rgba(15, 74, 156, 0.2);
        }

        .form-card {
            background: var(--surface);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: var(--radius-xl);
            backdrop-filter: blur(14px);
            box-shadow: var(--shadow-soft);
            overflow: hidden;
            animation: fadeInUp 0.62s ease both;
            transition: var(--transition);
        }

        .form-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-strong);
        }

        .card-header {
            position: relative;
            padding: 30px 32px 22px;
            border-bottom: 1px solid var(--line-soft);
            background: linear-gradient(120deg, rgba(79, 172, 254, 0.11), rgba(0, 198, 255, 0.08));
        }

        .card-header::after {
            content: '';
            position: absolute;
            inset: 0;
            border-bottom: 1px solid rgba(79, 172, 254, 0.14);
            pointer-events: none;
        }

        .badge-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border-radius: var(--radius-pill);
            font-size: 0.8rem;
            font-weight: 600;
            color: #135aa9;
            background: rgba(79, 172, 254, 0.17);
            padding: 6px 12px;
            margin-bottom: 14px;
        }

        .title {
            font-size: clamp(1.6rem, 4vw, 2.2rem);
            line-height: 1.2;
            margin-bottom: 9px;
            color: #0c2f5e;
            font-weight: 800;
        }

        .subtitle {
            color: var(--muted);
            line-height: 1.7;
            font-size: 0.95rem;
            max-width: 620px;
        }

        .form-body {
            padding: 28px 32px 34px;
            background: var(--surface-strong);
        }

        .grid {
            display: grid;
            gap: 18px;
            grid-template-columns: 1fr;
        }

        .field-group {
            display: grid;
            gap: 8px;
        }

        .field-group.two-col {
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .field-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #1b3a62;
            margin-left: 2px;
        }

        .field-label i {
            width: 18px;
            text-align: center;
            color: #1674d9;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #2190e6;
            pointer-events: none;
            transition: var(--transition);
            font-size: 0.92rem;
        }

        .input,
        .select,
        .textarea {
            width: 100%;
            border: 1px solid var(--line);
            background: #fff;
            border-radius: var(--radius-md);
            font: inherit;
            color: #1d2d44;
            transition: var(--transition);
        }

        .input,
        .select {
            min-height: 49px;
            padding: 0 14px 0 42px;
        }

        .textarea {
            min-height: 130px;
            resize: vertical;
            padding: 12px 14px;
            line-height: 1.6;
        }

        .input::placeholder,
        .textarea::placeholder {
            color: #8ca1bc;
        }

        .input:hover,
        .select:hover,
        .textarea:hover {
            border-color: rgba(33, 144, 230, 0.55);
        }

        .input:focus,
        .select:focus,
        .textarea:focus {
            outline: none;
            border-color: #1996ec;
            box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.18);
            transform: translateY(-1px);
        }

        .input:focus + .input-icon,
        .select:focus + .input-icon {
            color: #0b63cc;
        }

        .error-text {
            color: var(--danger);
            font-size: 0.83rem;
            font-weight: 500;
            margin-left: 2px;
            min-height: 18px;
        }

        .description-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            font-size: 0.78rem;
            color: #6f84a1;
            margin-top: 6px;
            margin-left: 2px;
        }

        .button-row {
            margin-top: 8px;
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
            gap: 10px;
            min-height: 50px;
            border-radius: 14px;
            font: inherit;
            font-size: 0.95rem;
            font-weight: 600;
            padding: 0 20px;
            transition: var(--transition);
        }

        .btn-submit {
            flex: 1 1 250px;
            color: #fff;
            background: linear-gradient(120deg, var(--blue-start), var(--blue-end));
            box-shadow: 0 16px 32px rgba(8, 125, 225, 0.34);
        }

        .btn-submit:hover {
            transform: translateY(-2px) scale(1.01);
            filter: brightness(1.03);
            box-shadow: 0 24px 36px rgba(8, 125, 225, 0.4);
        }

        .btn-cancel {
            flex: 0 1 180px;
            color: #1b4f89;
            background: #fff;
            border: 1px solid var(--line);
            box-shadow: 0 10px 20px rgba(15, 74, 156, 0.1);
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            border-color: rgba(25, 150, 236, 0.62);
            color: #0d62b3;
            box-shadow: 0 16px 24px rgba(15, 74, 156, 0.16);
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 58px 0 74px;
            }

            .card-header,
            .form-body {
                padding-inline: 22px;
            }

            .field-group.two-col {
                grid-template-columns: 1fr;
            }

            .button-row {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                flex: 1 1 auto;
            }
        }

        @media (max-width: 450px) {
            .mini-nav-link {
                width: 100%;
                justify-content: center;
            }

            .title {
                font-size: 1.48rem;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes drift {
            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(10px, -8px);
            }
        }
    </style>
</head>
<body>
    <div class="bg-blob one"></div>
    <div class="bg-blob two"></div>

    <main class="page-wrapper">
        <nav class="mini-navbar" aria-label="Navigasi mini laporan">
            <a href="{{ route('reports.index') }}" class="mini-nav-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </nav>

        <section class="form-card" aria-label="Form laporan bencana">
            <header class="card-header">
                <span class="badge-label">
                    <i class="fa-solid fa-shield-heart"></i>
                    Form Pelaporan
                </span>
                <h1 class="title">Laporkan Bencana</h1>
                <p class="subtitle">
                    Isi data kejadian secara lengkap agar tim dapat melakukan verifikasi dan tindak lanjut lebih cepat.
                </p>
            </header>

            <div class="form-body">
                <form action="{{ route('reports.store') }}" method="POST" novalidate>
                    @csrf
                    <input type="hidden" name="status" value="{{ old('status', 'Diproses') }}">

                    <div class="field">
                        <label for="disaster_status" class="field-label">Status Bencana</label>
                        <select id="disaster_status" name="disaster_status" class="select" required>
                            <option value="Terjadi" {{ old('disaster_status') === 'Terjadi' ? 'selected' : '' }}>Terjadi</option>
                            <option value="Prediksi" {{ old('disaster_status', 'Prediksi') === 'Prediksi' ? 'selected' : '' }}>Prediksi</option>
                            <option value="Selesai" {{ old('disaster_status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        <p class="error-text">@error('disaster_status') {{ $message }} @enderror</p>
                    </div>

                    <div class="grid">
                        <div class="field-group">
                            <label for="title" class="field-label">
                                <i class="fa-solid fa-heading"></i>
                                Judul Laporan
                            </label>
                            <div class="input-wrap">
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    class="input"
                                    placeholder="Contoh: Banjir di Kelurahan Sukamaju"
                                    value="{{ old('title') }}"
                                    required
                                >
                                <i class="fa-solid fa-file-signature input-icon"></i>
                            </div>
                            <p class="error-text">@error('title') {{ $message }} @enderror</p>
                        </div>

                        <div class="field-group two-col">
                            <div class="field-group">
                                <label for="disaster_type" class="field-label">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    Jenis Bencana
                                </label>
                                <div class="input-wrap">
                                    <select id="disaster_type" name="disaster_type" class="select" required>
                                        <option value="">Pilih jenis bencana</option>
                                        <option value="Gempa" {{ old('disaster_type') === 'Gempa' ? 'selected' : '' }}>Gempa</option>
                                        <option value="Banjir" {{ old('disaster_type') === 'Banjir' ? 'selected' : '' }}>Banjir</option>
                                        <option value="Tsunami" {{ old('disaster_type') === 'Tsunami' ? 'selected' : '' }}>Tsunami</option>
                                        <option value="Tanah Longsor" {{ old('disaster_type') === 'Tanah Longsor' ? 'selected' : '' }}>Tanah Longsor</option>
                                        <option value="Gunung Meletus" {{ old('disaster_type') === 'Gunung Meletus' ? 'selected' : '' }}>Gunung Meletus</option>
                                    </select>
                                    <i class="fa-solid fa-list-check input-icon"></i>
                                </div>
                                <p class="error-text">@error('disaster_type') {{ $message }} @enderror</p>
                            </div>

                            <div class="field-group">
                                <label for="report_date" class="field-label">
                                    <i class="fa-regular fa-calendar-days"></i>
                                    Tanggal Kejadian
                                </label>
                                <div class="input-wrap">
                                    <input
                                        type="date"
                                        id="report_date"
                                        name="report_date"
                                        class="input"
                                        value="{{ old('report_date') }}"
                                        max="{{ now()->toDateString() }}"
                                        required
                                    >
                                    <i class="fa-solid fa-calendar-check input-icon"></i>
                                </div>
                                <p class="error-text">@error('report_date') {{ $message }} @enderror</p>
                            </div>
                        </div>

                        <div class="field-group">
                            <label for="location" class="field-label">
                                <i class="fa-solid fa-location-dot"></i>
                                Lokasi Kejadian
                            </label>
                            <div class="input-wrap">
                                <input
                                    type="text"
                                    id="location"
                                    name="location"
                                    class="input"
                                    placeholder="Contoh: Kecamatan Cidadap, Bandung"
                                    value="{{ old('location') }}"
                                    required
                                >
                                <i class="fa-solid fa-map-location-dot input-icon"></i>
                            </div>
                            <p class="error-text">@error('location') {{ $message }} @enderror</p>
                        </div>

                        <div class="field-group">
                            <label for="description" class="field-label">
                                <i class="fa-regular fa-note-sticky"></i>
                                Deskripsi Kejadian
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                class="textarea"
                                placeholder="Jelaskan kondisi lapangan, dampak awal, dan kebutuhan bantuan darurat."
                                required
                            >{{ old('description') }}</textarea>
                            <div class="description-meta">
                                <span>Tulis ringkas, jelas, dan faktual.</span>
                                <span id="description-counter">0 karakter</span>
                            </div>
                            <p class="error-text">@error('description') {{ $message }} @enderror</p>
                        </div>

                        <div class="button-row">
                            <button type="submit" class="btn btn-submit">
                                <i class="fa-solid fa-paper-plane"></i>
                                Kirim Laporan
                            </button>
                            <a href="{{ route('reports.index') }}" class="btn btn-cancel">
                                <i class="fa-solid fa-xmark"></i>
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script>
        const disasterTypeSelect = document.getElementById('disaster_type');
        const descriptionField = document.getElementById('description');
        const counter = document.getElementById('description-counter');

        const disasterIcons = {
            Gempa: 'fa-house-crack',
            Banjir: 'fa-water',
            Tsunami: 'fa-wave-square',
            'Tanah Longsor': 'fa-mountain',
            'Gunung Meletus': 'fa-volcano'
        };

        function syncDisasterIcon() {
            const iconHolder = disasterTypeSelect.parentElement.querySelector('.input-icon');
            const selected = disasterTypeSelect.value;
            const iconClass = disasterIcons[selected] || 'fa-list-check';
            iconHolder.className = `fa-solid ${iconClass} input-icon`;
        }

        function syncDescriptionCounter() {
            const total = descriptionField.value.trim().length;
            counter.textContent = `${total} karakter`;
        }

        disasterTypeSelect.addEventListener('change', syncDisasterIcon);
        descriptionField.addEventListener('input', syncDescriptionCounter);

        syncDisasterIcon();
        syncDescriptionCounter();
    </script>
</body>
</html>
