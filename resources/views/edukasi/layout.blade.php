<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Edukasi | Siaga Bencana')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        :root {
            --bg-1: #eff8ff;
            --bg-2: #f8fcff;
            --surface: rgba(255, 255, 255, 0.86);
            --surface-strong: rgba(255, 255, 255, 0.96);
            --text: #0f1f3e;
            --muted: #526480;
            --accent: #0ea5e9;
            --accent-strong: #0369a1;
            --border: rgba(126, 188, 232, 0.28);
            --shadow: 0 24px 70px rgba(9, 68, 125, 0.14);
            --shadow-soft: 0 12px 30px rgba(9, 68, 125, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.92), transparent 34%),
                radial-gradient(circle at 85% 15%, rgba(171, 230, 255, 0.5), transparent 28%),
                linear-gradient(180deg, var(--bg-1) 0%, var(--bg-2) 38%, #ffffff 100%);
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image: radial-gradient(rgba(3, 105, 161, 0.05) 1px, transparent 1px);
            background-size: 26px 26px;
            opacity: 0.28;
            mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.75), transparent 92%);
        }

        .page-shell {
            position: relative;
            isolation: isolate;
            min-height: 100vh;
        }

        .page-shell::before,
        .page-shell::after {
            content: '';
            position: fixed;
            border-radius: 999px;
            filter: blur(12px);
            pointer-events: none;
            opacity: 0.7;
            z-index: -1;
        }

        .page-shell::before {
            width: 240px;
            height: 240px;
            background: rgba(56, 189, 248, 0.18);
            top: 120px;
            left: -80px;
        }

        .page-shell::after {
            width: 280px;
            height: 280px;
            background: rgba(14, 165, 233, 0.12);
            bottom: 40px;
            right: -80px;
        }

        .edu-nav {
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.7);
            border-bottom: 1px solid rgba(126, 188, 232, 0.24);
        }

        .edu-nav-inner {
            max-width: 1180px;
            margin: 0 auto;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .edu-brand {
            display: inline-flex;
            align-items: center;
            font-size: clamp(1.15rem, 1.4vw, 1.35rem);
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-decoration: none;
            color: #16a8e6;
        }

        .edu-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border-radius: 999px;
            border: 1px solid rgba(14, 165, 233, 0.16);
            color: #44586f;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.72);
            transition: transform 160ms ease, box-shadow 160ms ease, color 160ms ease, border-color 160ms ease;
        }

        .edu-back:hover {
            transform: translateY(-1px);
            color: var(--accent-strong);
            border-color: rgba(14, 165, 233, 0.34);
            box-shadow: 0 10px 24px rgba(9, 68, 125, 0.08);
        }

        .edu-main {
            max-width: 1180px;
            margin: 0 auto;
            padding: 1.8rem 1.25rem 4.5rem;
        }

        .hero-panel {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr);
            gap: 1.25rem;
            align-items: center;
            padding: 1.2rem;
        }

        .hero-copy {
            text-align: center;
            max-width: 860px;
            margin: 0 auto;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.55rem 1rem;
            margin-bottom: 1rem;
            border-radius: 999px;
            background: rgba(14, 165, 233, 0.12);
            color: var(--accent-strong);
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .hero-copy h1 {
            margin: 0;
            font-size: clamp(2.4rem, 5vw, 4.8rem);
            line-height: 0.98;
            letter-spacing: -0.05em;
            font-weight: 900;
        }

        .hero-copy p {
            max-width: 760px;
            margin: 1rem auto 0;
            color: var(--muted);
            font-size: clamp(1rem, 1.8vw, 1.18rem);
            line-height: 1.75;
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0.8rem;
            margin-top: 1.2rem;
        }

        .meta-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.72rem 1rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(126, 188, 232, 0.28);
            color: #38506a;
            font-size: 0.88rem;
            font-weight: 700;
            box-shadow: var(--shadow-soft);
        }

        .hero-media {
            display: grid;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .hero-image-frame {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            min-height: 360px;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.14), rgba(255, 255, 255, 0.75));
            border: 1px solid rgba(126, 188, 232, 0.28);
            box-shadow: var(--shadow);
        }

        .hero-image-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .hero-image-frame::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(3, 105, 161, 0.26), rgba(3, 105, 161, 0.02) 48%, rgba(255, 255, 255, 0) 100%);
        }

        .hero-note {
            position: absolute;
            left: 18px;
            bottom: 18px;
            max-width: min(360px, calc(100% - 36px));
            padding: 1rem 1.1rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 16px 34px rgba(9, 68, 125, 0.18);
            backdrop-filter: blur(10px);
            z-index: 1;
        }

        .hero-note h3 {
            margin: 0 0 0.35rem;
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text);
        }

        .hero-note p {
            margin: 0;
            color: var(--muted);
            font-size: 0.92rem;
            line-height: 1.6;
        }

        .article-shell {
            margin-top: 1.6rem;
            padding: 1.35rem;
            border-radius: 32px;
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(126, 188, 232, 0.22);
            box-shadow: var(--shadow-soft);
        }

        .content-stack {
            display: grid;
            gap: 1rem;
        }

        .content-card {
            border-radius: 24px;
            padding: 1.2rem 1.25rem;
            background: var(--surface-strong);
            border: 1px solid rgba(126, 188, 232, 0.18);
            box-shadow: 0 16px 36px rgba(9, 68, 125, 0.06);
        }

        .content-card p {
            margin: 0 0 1rem;
            color: #334155;
            font-size: 1.02rem;
            line-height: 1.8;
        }

        .content-card p:last-child {
            margin-bottom: 0;
        }

        .content-card ul,
        .content-card ol {
            margin: 0;
            padding-left: 1.15rem;
            color: #334155;
            line-height: 1.85;
        }

        .highlight-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 0.9rem;
        }

        .highlight-card {
            display: flex;
            gap: 0.85rem;
            align-items: flex-start;
            padding: 1rem;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(239, 248, 255, 0.96), rgba(255, 255, 255, 0.98));
            border: 1px solid rgba(14, 165, 233, 0.16);
        }

        .highlight-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            color: #fff;
            flex: 0 0 auto;
            background: linear-gradient(135deg, #38bdf8, #0ea5e9 55%, #0369a1);
            box-shadow: 0 10px 20px rgba(14, 165, 233, 0.2);
        }

        .highlight-card h3 {
            margin: 0 0 0.25rem;
            font-size: 1rem;
            font-weight: 800;
        }

        .highlight-card p {
            margin: 0;
            color: var(--muted);
            font-size: 0.94rem;
            line-height: 1.7;
        }

        .info-band {
            padding: 1rem 1.15rem;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.12), rgba(255, 255, 255, 0.96));
            border: 1px solid rgba(14, 165, 233, 0.18);
            color: #29445f;
            box-shadow: 0 14px 28px rgba(9, 68, 125, 0.05);
        }

        .info-band strong {
            color: var(--accent-strong);
        }

        .content-inline-title {
            margin: 0 0 0.85rem;
            font-size: 1.15rem;
            font-weight: 900;
            color: var(--text);
        }

        .status-list {
            display: grid;
            gap: 0.9rem;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.45rem 0.75rem;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        footer {
            margin-top: 1.2rem;
            padding: 1.6rem 1.25rem 2.4rem;
            text-align: center;
            color: #68809d;
            font-size: 0.9rem;
        }

        @media (min-width: 780px) {
            .hero-panel {
                padding: 2rem 2rem 1.4rem;
            }

            .article-shell {
                padding: 1.65rem;
            }

            .highlight-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 1060px) {
            .hero-panel {
                grid-template-columns: 0.98fr 1.02fr;
                gap: 2rem;
                text-align: left;
                padding: 2.3rem 2.2rem 1.4rem;
            }

            .hero-copy {
                text-align: left;
                margin: 0;
            }

            .hero-copy p {
                margin-left: 0;
            }

            .hero-meta {
                justify-content: flex-start;
            }

            .hero-media {
                margin-top: 0;
            }

            .highlight-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 640px) {
            .edu-nav-inner {
                padding: 0.9rem 1rem;
            }

            .edu-back {
                padding: 0.68rem 0.85rem;
                font-size: 0.84rem;
            }

            .edu-main {
                padding: 1.25rem 0.9rem 3.6rem;
            }

            .hero-panel {
                padding: 0.75rem 0.2rem 0.2rem;
            }

            .hero-image-frame {
                min-height: 260px;
                border-radius: 22px;
            }

            .hero-note {
                left: 12px;
                right: 12px;
                max-width: none;
            }

            .article-shell {
                padding: 1rem;
                border-radius: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="page-shell">
        <nav class="edu-nav">
            <div class="edu-nav-inner">
                <a href="{{ route('welcome') }}" class="edu-brand">
                    SIAGA BENCANA
                </a>
                <a href="{{ route('welcome') }}#edukasi" class="edu-back">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </nav>

        <main class="edu-main">
            <section class="hero-panel">
                <div class="hero-copy">
                    <div class="eyebrow">@yield('badge', 'Edukasi')</div>
                    <h1>@yield('heroTitle')</h1>
                    <p>@yield('heroSubtitle')</p>
                    <div class="hero-meta">
                        <span class="meta-chip"><i class="fa-solid fa-calendar-day text-sky-500"></i> @yield('metaDate', '08 Jun 2026')</span>
                        <span class="meta-chip"><i class="fa-solid fa-user-pen text-sky-500"></i> @yield('metaAuthor', 'Tim Edukasi')</span>
                    </div>
                </div>

                <div class="hero-media">
                    <div class="hero-image-frame">
                        <img src="@yield('heroImage')" alt="@yield('heroTitle')">
                        <div class="hero-note">
                            <h3>@yield('heroNoteTitle', 'Sorotan Cepat')</h3>
                            <p>@yield('heroNoteText')</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="article-shell">
                @yield('content')
            </section>
        </main>

        <footer>
            <div>© 2026 Siaga Bencana. Platform edukasi dan monitoring bencana Indonesia.</div>
        </footer>
    </div>
</body>
</html>