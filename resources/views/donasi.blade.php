<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi | Siaga Bencana</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue-start: #4facfe;
            --blue-end: #00c6ff;
            --blue-deep: #0b3f7a;
            --ink: #14243a;
            --muted: #5f7188;
            --surface: rgba(255, 255, 255, 0.9);
            --surface-strong: rgba(255, 255, 255, 0.96);
            --line: rgba(79, 172, 254, 0.2);
            --shadow-soft: 0 18px 40px rgba(15, 74, 156, 0.12);
            --shadow-strong: 0 28px 55px rgba(15, 74, 156, 0.2);
            --radius-xl: 24px;
            --radius-lg: 18px;
            --radius-md: 14px;
            --radius-pill: 999px;
            --transition: all 0.28s ease;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--ink);
            background: linear-gradient(135deg, #f5fbff 0%, #edf8ff 45%, #e6f5ff 100%);
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }

        .page-shell { width: min(1200px, calc(100% - 32px)); margin: 0 auto; padding: 28px 0 84px; }
        .top-link { display: inline-flex; align-items: center; gap: 10px; padding: 10px 18px; border-radius: var(--radius-pill); border: 1px solid var(--line); background: rgba(255, 255, 255, 0.85); color: #15518d; box-shadow: 0 12px 24px rgba(15, 74, 156, 0.12); transition: var(--transition); font-weight: 500; font-size: 0.93rem; }
        .top-link:hover { transform: translateY(-2px); box-shadow: 0 16px 28px rgba(15, 74, 156, 0.18); }

        .hero { position: relative; min-height: 520px; border-radius: 34px; overflow: hidden; margin-top: 18px; background: #0c2f57 url('../images/hero.jpg') center/cover no-repeat; box-shadow: var(--shadow-strong); animation: fadeUp 0.8s ease both; }
        .hero::before { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(9, 25, 50, 0.82), rgba(11, 63, 122, 0.66)); }
        .hero::after { content: ''; position: absolute; inset: 0; background: radial-gradient(circle at 20% 20%, rgba(79, 172, 254, 0.22), transparent 30%), radial-gradient(circle at 80% 10%, rgba(0, 198, 255, 0.18), transparent 26%); }
        .hero-inner { position: relative; z-index: 1; min-height: 520px; display: grid; align-items: center; padding: 40px clamp(22px, 4vw, 54px); }
        .hero-content { max-width: 760px; color: #fff; animation: fadeUp 0.95s ease both; }
        .eyebrow { display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; border-radius: var(--radius-pill); background: rgba(255, 255, 255, 0.14); border: 1px solid rgba(255, 255, 255, 0.14); margin-bottom: 18px; font-weight: 600; font-size: 0.84rem; letter-spacing: 0.2px; }
        .hero h1 { font-size: clamp(2.2rem, 5vw, 4.45rem); line-height: 1.02; margin-bottom: 18px; font-weight: 800; max-width: 11ch; }
        .hero p { font-size: clamp(1rem, 2vw, 1.1rem); line-height: 1.8; color: rgba(255, 255, 255, 0.88); max-width: 670px; margin-bottom: 28px; }
        .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; }

        .btn-primary { display: inline-flex; align-items: center; justify-content: center; gap: 10px; min-height: 52px; padding: 0 24px; border: none; border-radius: var(--radius-pill); color: #fff; font: inherit; font-weight: 700; cursor: pointer; background: linear-gradient(120deg, var(--blue-start), var(--blue-end)); box-shadow: 0 16px 30px rgba(8, 125, 225, 0.34); transition: var(--transition); }
        .btn-primary:hover { transform: translateY(-2px) scale(1.02); box-shadow: 0 22px 36px rgba(8, 125, 225, 0.42); }
        .btn-ghost { display: inline-flex; align-items: center; justify-content: center; gap: 10px; min-height: 52px; padding: 0 24px; border-radius: var(--radius-pill); color: #fff; border: 1px solid rgba(255, 255, 255, 0.34); background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(10px); font-weight: 600; transition: var(--transition); }
        .btn-ghost:hover { transform: translateY(-2px); background: rgba(255, 255, 255, 0.16); }

        .section { margin-top: 34px; animation: fadeUp 0.8s ease both; }
        .section-head { display: flex; justify-content: space-between; gap: 16px; align-items: flex-end; margin-bottom: 18px; flex-wrap: wrap; }
        .section-title { font-size: clamp(1.6rem, 3vw, 2.35rem); line-height: 1.16; color: #0f355f; margin-bottom: 8px; }
        .section-subtitle { color: var(--muted); max-width: 780px; line-height: 1.7; }

        .grid-stats { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
        .stat-card, .donation-card, .form-card, .history-card { background: var(--surface); border: 1px solid rgba(79, 172, 254, 0.18); border-radius: var(--radius-xl); box-shadow: var(--shadow-soft); transition: var(--transition); }
        .stat-card:hover, .donation-card:hover, .form-card:hover, .history-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-strong); }
        .stat-card { padding: 22px; display: flex; gap: 16px; align-items: center; }
        .stat-icon { width: 56px; height: 56px; border-radius: 18px; display: grid; place-items: center; font-size: 1.25rem; color: #fff; background: linear-gradient(120deg, var(--blue-start), var(--blue-end)); box-shadow: 0 14px 24px rgba(8, 125, 225, 0.28); flex-shrink: 0; }
        .stat-label { color: var(--muted); font-size: 0.92rem; margin-bottom: 6px; }
        .stat-value { font-size: clamp(1.4rem, 2.6vw, 2rem); font-weight: 800; color: #0f355f; line-height: 1.1; }

        .donation-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; }
        .donation-card { padding: 22px; display: flex; flex-direction: column; gap: 16px; }
        .disaster-top { display: flex; justify-content: space-between; gap: 12px; align-items: flex-start; }
        .disaster-icon { width: 54px; height: 54px; border-radius: 16px; display: grid; place-items: center; color: #0d4e86; background: linear-gradient(135deg, rgba(79, 172, 254, 0.14), rgba(0, 198, 255, 0.1)); border: 1px solid rgba(79, 172, 254, 0.16); flex-shrink: 0; }
        .badge { display: inline-flex; align-items: center; justify-content: center; padding: 8px 12px; border-radius: var(--radius-pill); background: rgba(79, 172, 254, 0.12); color: #0d59a3; font-size: 0.78rem; font-weight: 700; letter-spacing: 0.4px; text-transform: uppercase; white-space: nowrap; }
        .disaster-title { font-size: 1.08rem; font-weight: 800; color: #12345d; margin-bottom: 6px; }
        .meta { color: var(--muted); font-size: 0.9rem; line-height: 1.6; }
        .progress-wrap { display: grid; gap: 10px; }
        .progress-track { position: relative; height: 12px; border-radius: 999px; background: rgba(79, 172, 254, 0.12); overflow: hidden; }
        .progress-bar { height: 100%; width: 0; border-radius: inherit; background: linear-gradient(120deg, var(--blue-start), var(--blue-end)); box-shadow: 0 8px 18px rgba(8, 125, 225, 0.35); transition: width 1.2s ease; }
        .progress-info { display: flex; justify-content: space-between; gap: 12px; font-size: 0.88rem; color: #35516f; flex-wrap: wrap; }
        .donation-amount { font-weight: 700; color: #113b68; }
        .donate-link { display: inline-flex; align-items: center; justify-content: center; gap: 8px; width: 100%; min-height: 48px; border-radius: 14px; color: #fff; background: linear-gradient(120deg, var(--blue-start), var(--blue-end)); box-shadow: 0 14px 26px rgba(8, 125, 225, 0.28); transition: var(--transition); font-weight: 700; }
        .donate-link:hover { transform: translateY(-2px); box-shadow: 0 18px 30px rgba(8, 125, 225, 0.36); }

        .form-layout { display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 18px; }
        .form-card { padding: 24px; }
        .form-grid { display: grid; gap: 16px; }
        .field { display: grid; gap: 8px; }
        .label { display: inline-flex; align-items: center; gap: 8px; font-size: 0.92rem; font-weight: 600; color: #1b3b63; }
        .input, .select { width: 100%; min-height: 50px; padding: 0 15px; border-radius: var(--radius-md); border: 1px solid rgba(79, 172, 254, 0.24); background: #fff; color: #17395e; font: inherit; transition: var(--transition); }
        .input:focus, .select:focus { outline: none; border-color: #4a9dff; box-shadow: 0 0 0 4px rgba(79, 153, 255, 0.16); transform: translateY(-1px); }
        .input::placeholder { color: #90a2b9; }
        .quick-amounts { display: flex; flex-wrap: wrap; gap: 10px; }
        .quick-amount { border: 1px solid rgba(79, 172, 254, 0.22); background: rgba(255, 255, 255, 0.95); color: #15518d; border-radius: 999px; padding: 10px 14px; font: inherit; font-weight: 600; cursor: pointer; transition: var(--transition); }
        .quick-amount:hover, .quick-amount.is-active { background: linear-gradient(120deg, var(--blue-start), var(--blue-end)); border-color: transparent; color: #fff; box-shadow: 0 12px 24px rgba(8, 125, 225, 0.24); transform: translateY(-2px); }
        .payment-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
        .payment-option { display: block; }
        .payment-option input { display: none; }
        .payment-option span { display: flex; align-items: center; justify-content: center; gap: 10px; min-height: 54px; border-radius: 16px; border: 1px solid rgba(79, 172, 254, 0.22); background: rgba(255, 255, 255, 0.95); color: #15518d; font-weight: 700; transition: var(--transition); cursor: pointer; text-align: center; padding: 10px 14px; }
        .payment-option input:checked + span { color: #fff; background: linear-gradient(120deg, var(--blue-start), var(--blue-end)); box-shadow: 0 12px 24px rgba(8, 125, 225, 0.24); transform: translateY(-2px); }
        .helper { color: var(--muted); font-size: 0.84rem; line-height: 1.6; }
        .error-box { padding: 14px 16px; border-radius: 16px; background: rgba(239, 68, 68, 0.08); border: 1px solid rgba(239, 68, 68, 0.18); color: #a32121; font-size: 0.9rem; }
        .history-card { overflow: hidden; }
        .history-head { padding: 22px 24px 14px; border-bottom: 1px solid rgba(79, 172, 254, 0.14); }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 16px 24px; text-align: left; border-bottom: 1px solid rgba(79, 172, 254, 0.12); white-space: nowrap; }
        th { font-size: 0.83rem; text-transform: uppercase; letter-spacing: 0.4px; color: #3a5d81; background: rgba(79, 172, 254, 0.05); }
        td { color: #17395e; }
        .footer { margin-top: 34px; padding: 26px 24px; border-radius: 28px; color: #fff; background: linear-gradient(120deg, #0d365f, #0b4a87); box-shadow: var(--shadow-soft); }
        .footer-grid { display: grid; grid-template-columns: 1.1fr 0.9fr; gap: 18px; align-items: start; }
        .footer p { color: rgba(255, 255, 255, 0.82); line-height: 1.8; }
        .footer h3 { font-size: 1.25rem; margin-bottom: 10px; }
        .contact-list { list-style: none; display: grid; gap: 10px; margin-top: 10px; }
        .contact-list li { display: flex; gap: 10px; align-items: center; color: rgba(255,255,255,.88); }
        .flash { margin-bottom: 18px; padding: 14px 16px; border-radius: 16px; background: rgba(22, 163, 74, 0.1); border: 1px solid rgba(22, 163, 74, 0.18); color: #166534; font-weight: 600; box-shadow: 0 10px 22px rgba(22, 163, 74, 0.08); }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 1024px) { .grid-stats, .donation-grid, .form-layout, .footer-grid { grid-template-columns: 1fr; } .hero h1 { max-width: 100%; } }
        @media (max-width: 640px) { .page-shell { width: min(100% - 20px, 1200px); padding-top: 16px; } .hero { min-height: 560px; border-radius: 24px; } .hero-inner { padding: 22px 18px; } .hero-actions, .quick-amounts { width: 100%; } .btn-primary, .btn-ghost { width: 100%; } .payment-grid { grid-template-columns: 1fr; } th, td { padding: 14px 16px; } .form-card, .donation-card, .stat-card, .history-head { padding-left: 18px; padding-right: 18px; } }
    </style>
</head>
<body>
    <div class="page-shell">
        <a href="{{ url('/') }}" class="top-link"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>

        @if (session('success'))
            <div class="flash" id="flash-success">{{ session('success') }}</div>
        @endif

        <section class="hero">
            <div class="hero-inner">
                <div class="hero-content">
                    <div class="eyebrow"><i class="fa-solid fa-shield-heart"></i> Aksi cepat untuk korban bencana</div>
                    <h1>Bantu Korban Bencana Sekarang</h1>
                    <p>Setiap donasi yang Anda kirimkan membantu menyediakan makanan, kebutuhan darurat, serta harapan baru bagi keluarga yang sedang berjuang melewati masa sulit.</p>
                    <div class="hero-actions">
                        <a href="#form-donasi" class="btn-primary"><i class="fa-solid fa-hand-holding-heart"></i> Donasi Sekarang</a>
                        <a href="#bencana-aktif" class="btn-ghost"><i class="fa-solid fa-bolt"></i> Lihat Bencana Aktif</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="statistik">
            <div class="section-head">
                <div>
                    <h2 class="section-title">Statistik Donasi</h2>
                    <p class="section-subtitle">Ringkasan pergerakan bantuan yang sedang dikonsolidasikan oleh tim siaga bencana.</p>
                </div>
            </div>

            <div class="grid-stats">
                <article class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-sack-dollar"></i></div>
                    <div>
                        <div class="stat-label">Total Donasi Terkumpul</div>
                        <div class="stat-value">Rp {{ number_format($totalDonations, 0, ',', '.') }}</div>
                    </div>
                </article>

                <article class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                    <div>
                        <div class="stat-label">Jumlah Donatur</div>
                        <div class="stat-value">{{ number_format($totalDonors, 0, ',', '.') }}</div>
                    </div>
                </article>

                <article class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div>
                        <div class="stat-label">Bencana Terbantu</div>
                        <div class="stat-value">{{ $disastersHelped }}</div>
                    </div>
                </article>
            </div>
        </section>

        <section class="section" id="bencana-aktif">
            <div class="section-head">
                <div>
                    <h2 class="section-title">Informasi Bencana Aktif</h2>
                    <p class="section-subtitle">Pilih bencana yang ingin Anda bantu. Data di bawah ini diambil dari laporan BUMN dan status real-time yang tersedia.</p>
                </div>
            </div>

            <div class="donation-grid">
                @foreach ($activeDisasters as $disaster)
                    <article class="donation-card">
                        <div class="disaster-top">
                            <div style="display:flex; gap:14px; align-items:flex-start;">
                                <div class="disaster-icon"><i class="fa-solid {{ $disaster['icon'] }}"></i></div>
                                <div>
                                    <div class="disaster-title">{{ $disaster['title'] }}</div>
                                    <div class="meta"><i class="fa-solid fa-location-dot"></i> {{ $disaster['location'] }}</div>
                                    <div class="meta"><i class="fa-regular fa-calendar"></i> {{ $disaster['date'] }}</div>
                                </div>
                            </div>
                            <span class="badge">{{ $disaster['tag'] }}</span>
                        </div>

                        <div class="progress-wrap progress-observer" data-progress="{{ $disaster['progress'] }}">
                            <div class="progress-info">
                                <span>Progres Donasi</span>
                                <strong>{{ $disaster['progress'] }}%</strong>
                            </div>
                            <div class="progress-track">
                                <div class="progress-bar"></div>
                            </div>
                        </div>

                        <div class="progress-info">
                            <span class="donation-amount">Target: Rp {{ number_format($disaster['target'], 0, ',', '.') }}</span>
                            <span class="donation-amount">Terkumpul: Rp {{ number_format($disaster['collected'], 0, ',', '.') }}</span>
                        </div>
                        <div class="meta">{{ number_format($disaster['donors'], 0, ',', '.') }} donatur telah membantu bencana ini.</div>
                        <a href="#form-donasi" class="donate-link"><i class="fa-solid fa-heart"></i> Donasi</a>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="section" id="form-donasi">
            <div class="section-head">
                <div>
                    <h2 class="section-title">Form Donasi</h2>
                    <p class="section-subtitle">Isi data Anda, pilih nominal cepat atau masukkan nominal custom, lalu tentukan metode pembayaran yang paling mudah untuk Anda.</p>
                </div>
            </div>

            <div class="form-layout">
                <form class="form-card" action="{{ route('donasi.store') }}" method="POST" id="donation-form">
                    @csrf

                    @if ($errors->any())
                        <div class="error-box">
                            Mohon periksa kembali data yang Anda isi. Semua field wajib diisi.
                        </div>
                    @endif

                    <div class="form-grid">
                        <div class="field">
                            <label class="label" for="donor_name"><i class="fa-solid fa-user"></i> Nama Donatur</label>
                            <input type="text" id="donor_name" name="donor_name" class="input" value="{{ old('donor_name') }}" placeholder="Masukkan nama lengkap" required>
                            @error('donor_name')<small class="helper" style="color:#dc2626;">{{ $message }}</small>@enderror
                        </div>

                        <div class="field">
                            <label class="label" for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                            <input type="email" id="email" name="email" class="input" value="{{ old('email') }}" placeholder="nama@email.com" required>
                            @error('email')<small class="helper" style="color:#dc2626;">{{ $message }}</small>@enderror
                        </div>

                        <div class="field">
                            <label class="label"><i class="fa-solid fa-money-bill-wave"></i> Nominal Donasi</label>
                            <div class="quick-amounts">
                                <button type="button" class="quick-amount" data-amount="10000">Rp 10.000</button>
                                <button type="button" class="quick-amount" data-amount="25000">Rp 25.000</button>
                                <button type="button" class="quick-amount" data-amount="50000">Rp 50.000</button>
                                <button type="button" class="quick-amount" data-amount="100000">Rp 100.000</button>
                                <button type="button" class="quick-amount" data-amount="250000">Rp 250.000</button>
                            </div>
                            <input type="text" id="amount" name="amount" class="input" value="{{ old('amount') }}" placeholder="Atau ketik nominal custom, contoh: 75000" required inputmode="numeric">
                            <div class="helper">Klik nominal cepat untuk mengisi otomatis, atau ketik nominal lain sesuai kemampuan Anda.</div>
                            @error('amount')<small class="helper" style="color:#dc2626;">{{ $message }}</small>@enderror
                        </div>

                        <div class="field">
                            <label class="label"><i class="fa-solid fa-credit-card"></i> Metode Pembayaran</label>
                            <div class="payment-grid">
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="Transfer Bank" {{ old('payment_method') === 'Transfer Bank' ? 'checked' : '' }} required>
                                    <span><i class="fa-solid fa-building-columns"></i> Transfer Bank</span>
                                </label>
                                <label class="payment-option">
                                    <input type="radio" name="payment_method" value="E-Wallet" {{ old('payment_method') === 'E-Wallet' ? 'checked' : '' }} required>
                                    <span><i class="fa-solid fa-wallet"></i> E-Wallet</span>
                                </label>
                            </div>
                            @error('payment_method')<small class="helper" style="color:#dc2626;">{{ $message }}</small>@enderror
                        </div>

                        <button type="submit" class="btn-primary" style="width:100%;"><i class="fa-solid fa-paper-plane"></i> Kirim Donasi</button>
                    </div>
                </form>

                <div class="history-card">
                    <div class="history-head">
                        <h3 class="section-title" style="font-size:1.4rem; margin-bottom:6px;">Kenapa Donasi Ini Penting</h3>
                        <p class="section-subtitle">Bantuan yang terkumpul akan diprioritaskan untuk kebutuhan paling mendesak di lapangan.</p>
                    </div>
                    <div style="padding:24px; display:grid; gap:16px;">
                        <div class="stat-card" style="padding:18px; box-shadow:none;">
                            <div class="stat-icon"><i class="fa-solid fa-kit-medical"></i></div>
                            <div>
                                <div class="stat-label">Bantuan Cepat</div>
                                <div class="meta">Logistik darurat, dapur umum, dan kebutuhan dasar.</div>
                            </div>
                        </div>
                        <div class="stat-card" style="padding:18px; box-shadow:none;">
                            <div class="stat-icon"><i class="fa-solid fa-house-circle-check"></i></div>
                            <div>
                                <div class="stat-label">Pemulihan</div>
                                <div class="meta">Dukungan untuk keluarga terdampak agar bisa bangkit kembali.</div>
                            </div>
                        </div>
                        <div class="stat-card" style="padding:18px; box-shadow:none;">
                            <div class="stat-icon"><i class="fa-solid fa-shield-heart"></i></div>
                            <div>
                                <div class="stat-label">Transparansi</div>
                                <div class="meta">Ringkasan penyaluran bantuan dapat ditampilkan dari data laporan bencana.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section" id="riwayat">
            <div class="section-head">
                <div>
                    <h2 class="section-title">Riwayat Donasi</h2>
                    <p class="section-subtitle">Contoh data donasi terbaru yang dapat diperluas menjadi riwayat real-time dari database.</p>
                </div>
            </div>

            <div class="history-card">
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Nominal</th>
                                <th>Metode</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody id="donation-history-body">
                            @foreach ($donationHistory as $row)
                                <tr>
                                    <td>{{ $row['name'] }}</td>
                                    <td>Rp {{ number_format($row['amount'], 0, ',', '.') }}</td>
                                    <td>{{ $row['payment_method'] ?? '-' }}</td>
                                    <td>{{ $row['date'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="section" id="charts" style="margin-top:28px;">
            <div class="section-head">
                <div>
                    <h2 class="section-title">Grafik Statistik Donasi</h2>
                    <p class="section-subtitle">Perkembangan donasi dan distribusi metode pembayaran.</p>
                </div>
            </div>

            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:18px;">
                <div class="form-card" style="padding:18px;">
                    <canvas id="lineChart"></canvas>
                </div>
                <div style="display:grid; gap:18px;">
                    <div class="form-card" style="padding:18px;"><canvas id="barChart"></canvas></div>
                    <div class="form-card" style="padding:18px;"><canvas id="doughnutChart"></canvas></div>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="footer-grid">
                <div>
                    <h3>Pesan Kemanusiaan</h3>
                    <p>Kami percaya bahwa setiap langkah kecil dapat menyelamatkan banyak kehidupan. Mari bergerak bersama untuk membantu saudara-saudara kita yang sedang terdampak bencana.</p>
                </div>
                <div>
                    <h3>Kontak</h3>
                    <ul class="contact-list">
                        <li><i class="fa-solid fa-envelope"></i> bantuan@siagabencana.id</li>
                        <li><i class="fa-solid fa-phone"></i> +62 812-3456-7890</li>
                        <li><i class="fa-solid fa-location-dot"></i> Indonesia</li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    <script>
        const amountInput = document.getElementById('amount');
        const quickButtons = document.querySelectorAll('.quick-amount');
        const progressBars = document.querySelectorAll('.progress-observer');
        const historyBody = document.getElementById('donation-history-body');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const endpoints = {
            store: '{{ route('api.donations.store') }}',
            charts: '{{ route('api.donations.charts') }}',
            stats: '{{ route('api.donations.stats') }}',
            history: '{{ route('api.donations.history') }}'
        };

        const formatNumber = (value) => {
            const digits = String(value || '').replace(/\D/g, '');
            if (!digits) return '';
            return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        };

        const unformatNumber = (value) => Number(String(value || '').replace(/\D/g, '') || 0);

        const setActiveAmount = (amount) => {
            quickButtons.forEach((button) => {
                button.classList.toggle('is-active', button.dataset.amount === String(amount));
            });
        };

        quickButtons.forEach((button) => {
            button.addEventListener('click', () => {
                amountInput.value = formatNumber(button.dataset.amount);
                setActiveAmount(button.dataset.amount);
                amountInput.focus();
            });
        });

        amountInput.addEventListener('input', (event) => {
            const digits = String(event.target.value).replace(/\D/g, '');
            event.target.value = formatNumber(digits);
            setActiveAmount('');
        });

        const form = document.getElementById('donation-form');
        const submitButton = form.querySelector('button[type="submit"]');

        const setLoading = (isLoading) => {
            if (isLoading) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';
            } else {
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Kirim Donasi';
            }
        };

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const amountInt = unformatNumber(formData.get('amount'));

            if (!amountInt || amountInt < 10000) {
                Swal.fire({ icon: 'error', title: 'Nominal tidak valid', text: 'Minimal donasi Rp 10.000', confirmButtonColor: '#4facfe' });
                return;
            }

            const payload = {
                donor_name: formData.get('donor_name'),
                email: formData.get('email'),
                amount: amountInt,
                payment_method: formData.get('payment_method'),
                report_id: formData.get('report_id') || null,
                message: formData.get('message') || null,
            };

            try {
                setLoading(true);
                const res = await fetch(endpoints.store, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const data = await res.json();

                if (!res.ok) {
                    const msg = data?.errors ? Object.values(data.errors).flat().join('\n') : (data.message || 'Terjadi kesalahan');
                    Swal.fire({ icon: 'error', title: 'Gagal', text: msg, confirmButtonColor: '#4facfe' });
                    return;
                }

                Swal.fire({ icon: 'success', title: 'Terima kasih!', text: 'Donasi Anda berhasil dikirim.', confirmButtonColor: '#4facfe' });

                form.reset();
                setActiveAmount('');

                if (data.stats) updateStats(data.stats);
                if (data.donation) addHistoryRow(data.donation);
                await fetchAndUpdateCharts();

            } catch (err) {
                console.error(err);
                Swal.fire({ icon: 'error', title: 'Error', text: 'Tidak dapat mengirim donasi. Coba lagi.', confirmButtonColor: '#4facfe' });
            } finally {
                setLoading(false);
            }
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const bar = entry.target.querySelector('.progress-bar');
                    const progress = entry.target.dataset.progress || '0';
                    bar.style.width = progress + '%';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.35 });

        progressBars.forEach((item) => observer.observe(item));

        const statNodes = {
            totalDonations: document.querySelectorAll('.stat-card .stat-value')[0],
            totalDonors: document.querySelectorAll('.stat-card .stat-value')[1],
            disastersHelped: document.querySelectorAll('.stat-card .stat-value')[2]
        };

        const animateCount = (node, from, to, formatter) => {
            const duration = 700;
            const start = performance.now();
            const parse = Number(from) || 0;
            const end = Number(to) || 0;

            const frame = (now) => {
                const progress = Math.min((now - start) / duration, 1);
                const current = Math.round(parse + (end - parse) * progress);
                node.textContent = formatter ? formatter(current) : current;
                if (progress < 1) requestAnimationFrame(frame);
            };
            requestAnimationFrame(frame);
        };

        const formatRupiah = (v) => 'Rp ' + (Number(v) ? Number(v).toLocaleString('id-ID') : '0');

        const updateStats = (stats) => {
            if (!stats) return;
            animateCount(statNodes.totalDonations, statNodes.totalDonations.textContent.replace(/\D/g, ''), stats.totalDonations, (n) => formatRupiah(n));
            animateCount(statNodes.totalDonors, statNodes.totalDonors.textContent.replace(/\D/g, ''), stats.totalDonors, (n) => n.toLocaleString('id-ID'));
            animateCount(statNodes.disastersHelped, statNodes.disastersHelped.textContent.replace(/\D/g, ''), stats.disastersHelped, (n) => n);
        };

        const addHistoryRow = (donation) => {
            if (!donation) return;
            const tr = document.createElement('tr');
            tr.style.opacity = 0;
            tr.innerHTML = `
                <td>${donation.name}</td>
                <td>${formatRupiah(donation.amount)}</td>
                <td>${donation.payment_method || '-'}</td>
                <td>${donation.date}</td>
            `;
            if (historyBody) {
                historyBody.prepend(tr);
                setTimeout(() => { tr.style.transition = 'opacity 400ms, transform 400ms'; tr.style.opacity = 1; tr.style.transform = 'translateY(0)'; }, 20);
            }
        };

        let lineChart, barChart, doughnutChart;

        const fetchChartData = async () => {
            const res = await fetch(endpoints.charts);
            return res.ok ? res.json() : null;
        };

        const initCharts = async () => {
            const data = await fetchChartData();
            if (!data || !data.data) return;
            const payload = data.data;

            const lineCtx = document.getElementById('lineChart').getContext('2d');
            const barCtx = document.getElementById('barChart').getContext('2d');
            const doughCtx = document.getElementById('doughnutChart').getContext('2d');

            lineChart = new Chart(lineCtx, {
                type: 'line',
                data: { labels: payload.labels, datasets: [{ label: 'Perkembangan Donasi', data: payload.cumulative, borderColor: '#2ea8ff', backgroundColor: 'rgba(46,168,255,0.12)', tension: 0.3, fill: true }] },
                options: { responsive: true, plugins: { legend: { display: false } } }
            });

            barChart = new Chart(barCtx, {
                type: 'bar',
                data: { labels: payload.labels, datasets: [{ label: 'Donasi per Hari', data: payload.donationsPerDay, backgroundColor: '#4facfe' }] },
                options: { responsive: true, plugins: { legend: { display: false } } }
            });

            doughnutChart = new Chart(doughCtx, {
                type: 'doughnut',
                data: { labels: Object.keys(payload.paymentMethods), datasets: [{ data: Object.values(payload.paymentMethods), backgroundColor: ['#2ea8ff', '#00c6ff', '#b6f3ff'] }] },
                options: { responsive: true }
            });
        };

        const fetchAndUpdateCharts = async () => {
            const json = await fetchChartData();
            if (!json || !json.data) return;
            const d = json.data;
            if (lineChart) { lineChart.data.labels = d.labels; lineChart.data.datasets[0].data = d.cumulative; lineChart.update(); }
            if (barChart) { barChart.data.labels = d.labels; barChart.data.datasets[0].data = d.donationsPerDay; barChart.update(); }
            if (doughnutChart) { doughnutChart.data.labels = Object.keys(d.paymentMethods); doughnutChart.data.datasets[0].data = Object.values(d.paymentMethods); doughnutChart.update(); }
        };

        document.addEventListener('DOMContentLoaded', async () => {
            await initCharts();
            try {
                const statsRes = await fetch(endpoints.stats);
                if (statsRes.ok) { const js = await statsRes.json(); if (js.success) updateStats(js.data); }
                const histRes = await fetch(endpoints.history);
                if (histRes.ok) { const js = await histRes.json(); if (js.success && js.data) { if (historyBody) { historyBody.innerHTML = ''; js.data.forEach(d => addHistoryRow(d)); } } }
            } catch (err) { console.error('Init fetch error', err); }
        });

        @if (session('success'))
            Swal.fire({ icon: 'success', title: 'Donasi berhasil dikirim', text: @json(session('success')), confirmButtonColor: '#4facfe', confirmButtonText: 'Tutup' });
        @endif

        @if (old('amount'))
            setActiveAmount(String({{ preg_replace('/[^0-9]/', '', old('amount')) ?: '0' }}));
        @endif
    </script>
</body>
</html>