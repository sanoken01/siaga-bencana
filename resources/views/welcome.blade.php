<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAGA BENCANA - Platform Monitoring Bencana Indonesia</title>

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        /* ============================================================
           GLOBAL RESET & ROOT
        ============================================================ */
        :root {
            --blue-start: #4facfe;
            --blue-end: #00c6ff;
            --blue-dark: #0b3f7a;
            --blue-deep: #072c57;
            --cyan-soft: #b6f3ff;
            --pink-soft: #ffd8f0;
            --white: #ffffff;
            --text-primary: #0f1f3e;
            --text-secondary: #4a5d7a;
            --border-soft: rgba(255, 255, 255, 0.26);
            --glass-bg: rgba(255, 255, 255, 0.18);
            --glass-bg-2: rgba(255, 255, 255, 0.24);
            --shadow-soft: 0 15px 40px rgba(16, 116, 185, 0.16);
            --shadow-medium: 0 14px 35px rgba(16, 116, 185, 0.22);
            --shadow-strong: 0 16px 44px rgba(8, 63, 122, 0.3);
            --radius-lg: 20px;
            --radius-pill: 999px;
            --space-section: 110px;
            --transition-fast: 0.3s ease;
            --transition-medium: 0.4s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-primary);
            background: linear-gradient(135deg, #eef9ff 0%, #f6fcff 36%, #e6f6ff 100%);
            overflow-x: hidden;
            animation: pageFadeIn 1s ease;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        img {
            max-width: 100%;
            display: block;
        }

        .container {
            width: min(1180px, 92%);
            margin-inline: auto;
        }

        .gradient-text {
            background: linear-gradient(90deg, var(--blue-start), var(--blue-end), #5ed0ff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientFlow 6s ease infinite;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 2.6rem;
        }

        .section-heading .tag {
            display: inline-block;
            padding: 0.45rem 1rem;
            border-radius: var(--radius-pill);
            background: rgba(79, 172, 254, 0.12);
            color: #1976b8;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.9rem;
        }

        .section-heading h2 {
            font-size: clamp(1.8rem, 4vw, 2.6rem);
            line-height: 1.2;
            margin-bottom: 0.6rem;
        }

        .section-heading p {
            color: var(--text-secondary);
            max-width: 720px;
            margin-inline: auto;
        }

        .section-padding {
            padding: var(--space-section) 0;
        }

        .glass {
            background: var(--glass-bg);
            border: 1px solid var(--border-soft);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-radius: var(--radius-lg);
        }

        /* ============================================================
           STICKY NAVBAR TRANSPARENT
        ============================================================ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1200;
            transition: background var(--transition-medium), box-shadow var(--transition-medium), border-color var(--transition-medium);
            border-bottom: 1px solid transparent;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.86);
            border-bottom: 1px solid rgba(79, 172, 254, 0.23);
            box-shadow: 0 8px 28px rgba(11, 63, 122, 0.11);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .nav-inner {
            min-height: 78px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .logo {
            font-size: clamp(1.2rem, 2vw, 1.48rem);
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
        }

        .nav-menu {
            list-style: none;
            display: flex;
            align-items: center;
            gap: 1.35rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .nav-menu a {
            color: #0d4685;
            font-weight: 500;
            padding-bottom: 0.24rem;
            position: relative;
            transition: color var(--transition-fast);
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 100%;
            height: 2px;
            border-radius: 999px;
            background: linear-gradient(90deg, var(--blue-start), var(--blue-end));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform var(--transition-fast);
        }

        .nav-menu a:hover {
            color: #0a5fa5;
        }

        .nav-menu a:hover::after {
            transform: scaleX(1);
        }

        .btn-login-admin {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.66rem 1.1rem;
            border-radius: var(--radius-pill);
            color: #fff;
            font-weight: 600;
            font-size: 0.88rem;
            background: linear-gradient(90deg, #3db4ff, #008eff);
            box-shadow: 0 8px 20px rgba(0, 142, 255, 0.3);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
        }

        .btn-login-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(0, 142, 255, 0.35);
        }

        .btn-register {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            margin-left: 0.55rem;
            padding: 0.66rem 1.1rem;
            border-radius: var(--radius-pill);
            color: #0b4f86;
            font-weight: 600;
            font-size: 0.88rem;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.95);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(0, 85, 153, 0.18);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .profile-dropdown-wrap {
            position: relative;
        }

        .profile-trigger {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.4rem 0.7rem 0.4rem 0.42rem;
            border-radius: var(--radius-pill);
            border: 1px solid rgba(79, 172, 254, 0.26);
            background: rgba(255, 255, 255, 0.92);
            color: #0c4f8a;
            font-family: inherit;
            font-weight: 600;
            cursor: pointer;
            transition: box-shadow var(--transition-fast), transform var(--transition-fast), border-color var(--transition-fast);
        }

        .profile-trigger:hover {
            transform: translateY(-1px);
            border-color: rgba(0, 142, 255, 0.42);
            box-shadow: 0 10px 20px rgba(0, 109, 190, 0.14);
        }

        .profile-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(79, 172, 254, 0.28);
        }

        .profile-avatar--fallback {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4facfe, #00c6ff);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.15);
            transition: box-shadow var(--transition-fast);
        }

        .profile-trigger:hover .profile-avatar--fallback,
        .profile-trigger:hover .profile-avatar {
            box-shadow: 0 0 0 4px rgba(79, 172, 254, 0.24);
        }

        .profile-name {
            max-width: 140px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 0.9rem;
        }

        .profile-chevron {
            font-size: 0.78rem;
            color: #2f7ebd;
            transition: transform var(--transition-fast);
        }

        .profile-dropdown-wrap.is-open .profile-chevron {
            transform: rotate(180deg);
        }

        .profile-dropdown {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            min-width: 210px;
            border-radius: 14px;
            border: 1px solid rgba(79, 172, 254, 0.2);
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 14px 32px rgba(8, 63, 122, 0.16);
            padding: 0.45rem;
            opacity: 0;
            transform: translateY(10px);
            pointer-events: none;
            transition: opacity 0.22s ease, transform 0.22s ease;
            z-index: 1500;
        }

        .profile-dropdown-wrap.is-open .profile-dropdown {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .profile-menu-item {
            display: flex;
            align-items: center;
            gap: 0.62rem;
            width: 100%;
            border: 0;
            border-radius: 10px;
            background: transparent;
            color: #154a7c;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            text-align: left;
            padding: 0.62rem 0.7rem;
            cursor: pointer;
            transition: background var(--transition-fast), color var(--transition-fast);
        }

        .profile-menu-item:hover {
            background: rgba(79, 172, 254, 0.12);
            color: #0f5e9e;
        }

        .profile-menu-item i {
            width: 16px;
            text-align: center;
            color: #2f81c3;
        }

        .profile-menu-divider {
            height: 1px;
            margin: 0.26rem 0;
            background: rgba(15, 95, 160, 0.12);
        }

        .profile-logout {
            color: #b23b3b;
        }

        .profile-logout i {
            color: #c24a4a;
        }

        /* ============================================================
           HERO SECTION SUPER STARTUP
        ============================================================ */
        .hero {
            position: relative;
            min-height: 100vh;
            padding-top: 124px;
            display: flex;
            align-items: center;
            isolation: isolate;
            background:
                linear-gradient(130deg, rgba(79, 172, 254, 0.9), rgba(0, 198, 255, 0.82)),
                url("{{ asset('images/hero.jpg') }}") center / cover no-repeat;
            overflow: hidden;
        }

        .hero::before,
        .hero::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(2px);
            z-index: -1;
        }

        .hero::before {
            width: 380px;
            height: 380px;
            background: rgba(255, 216, 240, 0.36);
            top: -100px;
            left: -70px;
            animation: floatSoft 9s ease-in-out infinite;
        }

        .hero::after {
            width: 340px;
            height: 340px;
            background: rgba(182, 243, 255, 0.36);
            right: -70px;
            bottom: -120px;
            animation: floatSoft 11s ease-in-out infinite reverse;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.2rem;
            align-items: center;
            padding-bottom: 3rem;
        }

        .hero-text h1 {
            color: #fff;
            font-size: clamp(2rem, 4.7vw, 3.8rem);
            line-height: 1.16;
            font-weight: 800;
            margin-bottom: 1rem;
            animation: revealUp 0.9s ease both;
        }

        .hero-text p {
            color: rgba(255, 255, 255, 0.95);
            font-size: clamp(1rem, 2.1vw, 1.16rem);
            max-width: 640px;
            margin-bottom: 1.8rem;
            animation: revealUp 1.1s ease both;
        }

        .hero-cta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.9rem;
            animation: revealUp 1.25s ease both;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: none;
            border-radius: var(--radius-pill);
            padding: 0.95rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: transform var(--transition-fast), box-shadow var(--transition-fast), background var(--transition-fast), color var(--transition-fast);
        }

        .btn-primary {
            color: #fff;
            background: linear-gradient(90deg, #2ea8ff, #0076ff);
            box-shadow: 0 12px 26px rgba(0, 118, 255, 0.37);
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 0 0 7px rgba(186, 232, 255, 0.28), 0 18px 35px rgba(0, 118, 255, 0.42);
        }

        .btn-secondary {
            color: #0d4b87;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.95);
        }

        .btn-secondary:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(10, 70, 126, 0.2);
            background: #ffffff;
        }

        .hero-visual {
            position: relative;
            margin-inline: auto;
            width: min(460px, 100%);
            animation: revealUp 1.25s ease both;
        }

        .hero-visual-card {
            padding: 1.2rem;
            border-radius: 24px;
            background: var(--glass-bg-2);
            border: 1px solid rgba(255, 255, 255, 0.38);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: var(--shadow-soft);
            animation: floatingCard 4.8s ease-in-out infinite;
        }

        .visual-main-icon {
            width: 96px;
            height: 96px;
            border-radius: 28px;
            display: grid;
            place-items: center;
            font-size: 2.2rem;
            color: #ffffff;
            background: linear-gradient(135deg, #2ea8ff, #0084ff);
            box-shadow: 0 12px 28px rgba(0, 132, 255, 0.34);
            margin-bottom: 1rem;
        }

        .visual-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.25rem;
        }

        .visual-subtitle {
            color: rgba(255, 255, 255, 0.94);
            font-size: 0.92rem;
        }

        .floating-mini {
            position: absolute;
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            color: #fff;
            font-size: 1.25rem;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.28), rgba(255, 255, 255, 0.12));
            border: 1px solid rgba(255, 255, 255, 0.45);
            box-shadow: 0 12px 24px rgba(0, 68, 120, 0.2);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .floating-mini.fm-1 {
            top: -18px;
            right: 12px;
            animation: floatSoft 5s ease-in-out infinite;
        }

        .floating-mini.fm-2 {
            left: -16px;
            bottom: 36px;
            animation: floatSoft 6.5s ease-in-out infinite reverse;
        }

        .floating-mini.fm-3 {
            right: 32px;
            bottom: -18px;
            animation: floatSoft 7s ease-in-out infinite;
        }

        .hero-wave {
            position: absolute;
            left: 0;
            right: 0;
            bottom: -1px;
            line-height: 0;
        }

        .hero-wave svg {
            width: 100%;
            height: 105px;
            display: block;
        }

        /* ============================================================
           TRUSTED / SOCIAL PROOF
        ============================================================ */
        .trusted {
            background: #ffffff;
            padding: 44px 0 76px;
        }

        .trusted p {
            text-align: center;
            color: #5b6f8d;
            font-weight: 500;
            margin-bottom: 1.4rem;
        }

        .logo-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.9rem;
        }

        .logo-box {
            min-height: 76px;
            border-radius: 16px;
            border: 1px solid #e3eff8;
            background: #f8fbff;
            color: #93a4bc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            letter-spacing: 1px;
            filter: grayscale(100%);
            opacity: 0.75;
            transition: opacity var(--transition-fast), transform var(--transition-fast), border-color var(--transition-fast);
        }

        .logo-box:hover {
            opacity: 1;
            transform: translateY(-4px);
            border-color: #b8e6ff;
        }

        /* ============================================================
           STATISTIK SECTION
        ============================================================ */
        .stats {
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 12% 12%, rgba(255, 216, 240, 0.34), transparent 48%),
                radial-gradient(circle at 88% 22%, rgba(182, 243, 255, 0.34), transparent 46%),
                linear-gradient(130deg, #edf8ff 0%, #f8fdff 100%);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            padding: 1.4rem;
            border-radius: var(--radius-lg);
            background: var(--glass-bg-2);
            border: 1px solid rgba(255, 255, 255, 0.52);
            box-shadow: var(--shadow-soft);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            transition: transform var(--transition-medium), box-shadow var(--transition-medium), border-color var(--transition-medium);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            inset: 0;
            padding: 1px;
            border-radius: inherit;
            background: linear-gradient(120deg, rgba(79, 172, 254, 0.85), rgba(0, 198, 255, 0.85), rgba(255, 216, 240, 0.82));
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
            opacity: 0;
            transition: opacity var(--transition-fast);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-medium);
            border-color: rgba(115, 207, 255, 0.58);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.1rem;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: grid;
            place-items: center;
            color: #ffffff;
            font-size: 1.35rem;
            background: linear-gradient(135deg, #2daaff, #008dff);
            box-shadow: 0 10px 25px rgba(0, 141, 255, 0.3);
        }

        .stat-label {
            color: #4f6381;
            font-size: 0.94rem;
            margin-bottom: 0.2rem;
        }

        .stat-number {
            font-size: clamp(1.8rem, 4vw, 2.4rem);
            font-weight: 800;
            line-height: 1;
            margin-bottom: 0.35rem;
            color: #0e4d88;
        }

        .stat-note {
            color: #6d809c;
            font-size: 0.86rem;
        }

        /* ============================================================
           FITUR UNGGULAN GRID
        ============================================================ */
        .features {
            background: #ffffff;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
        }

        .feature-card {
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            background: rgba(240, 251, 255, 0.85);
            border: 1px solid rgba(128, 217, 255, 0.28);
            box-shadow: 0 10px 28px rgba(16, 116, 185, 0.09);
            backdrop-filter: blur(9px);
            -webkit-backdrop-filter: blur(9px);
            transition: transform var(--transition-medium), box-shadow var(--transition-medium);
        }

        .feature-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 18px 34px rgba(8, 96, 166, 0.17);
        }

        .feature-icon {
            width: 62px;
            height: 62px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #39b7ff, #0083f3);
            box-shadow: 0 12px 25px rgba(0, 131, 243, 0.3);
        }

        .feature-card h3 {
            font-size: 1.1rem;
            margin-bottom: 0.45rem;
        }

        .feature-card p {
            color: var(--text-secondary);
            font-size: 0.93rem;
        }

        /* ============================================================
           STATUS BENCANA TERKINI
        ============================================================ */
        .status-section {
            background: linear-gradient(145deg, #edf8ff 0%, #f8fcff 100%);
        }

        .status-list {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .status-card {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.9rem;
            align-items: center;
            padding: 1.35rem;
            border-radius: var(--radius-lg);
            background: #ffffff;
            border: 1px solid #d9eefc;
            box-shadow: 0 12px 26px rgba(12, 97, 159, 0.09);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
        }

        .status-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 36px rgba(12, 97, 159, 0.16);
        }

        .status-left {
            display: flex;
            align-items: center;
            gap: 0.85rem;
        }

        .status-icon {
            width: 52px;
            height: 52px;
            border-radius: 15px;
            display: grid;
            place-items: center;
            color: #fff;
            font-size: 1.3rem;
            background: linear-gradient(135deg, #43bcff, #008aff);
        }

        .status-info h3 {
            font-size: 1.06rem;
            margin-bottom: 0.2rem;
        }

        .status-info p {
            color: #60758f;
            font-size: 0.9rem;
        }

        .status-meta {
            display: flex;
            gap: 0.7rem;
            flex-wrap: wrap;
            align-items: center;
            justify-content: flex-start;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.85rem;
            border-radius: var(--radius-pill);
            font-size: 0.8rem;
            font-weight: 700;
            color: #fff;
        }

        .badge-siaga { background: #ef4444; }
        .badge-waspada { background: #f59e0b; }
        .badge-aman { background: #22c55e; }

        .btn-detail {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            border-radius: var(--radius-pill);
            padding: 0.5rem 0.95rem;
            background: #e9f7ff;
            color: #0f67aa;
            font-weight: 600;
            font-size: 0.86rem;
            transition: background var(--transition-fast), transform var(--transition-fast);
        }

        .btn-detail:hover {
            background: #d5efff;
            transform: translateY(-2px);
        }

        /* ============================================================
           PETA INTERAKTIF (MAIN FEATURE)
        ============================================================ */
        .map-section {
            background:
                radial-gradient(circle at 8% 20%, rgba(182, 243, 255, 0.46), transparent 36%),
                radial-gradient(circle at 88% 14%, rgba(255, 216, 240, 0.34), transparent 34%),
                linear-gradient(130deg, #edf8ff 0%, #f8fcff 100%);
            overflow: hidden;
        }

        .map-main-wrap {
            width: min(1340px, 96%);
            margin-inline: auto;
            text-align: center;
        }

        .map-main-heading {
            font-size: clamp(2.1rem, 4.8vw, 3.4rem);
            line-height: 1.12;
            font-weight: 800;
            margin-bottom: 0.72rem;
            color: #0d3f74;
        }

        .map-main-description {
            color: #4f6582;
            font-size: 1rem;
            margin-bottom: 2.15rem;
        }

        .map-display-card {
            min-height: 520px;
            border-radius: 30px;
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(130deg, rgba(79, 172, 254, 0.2), rgba(0, 198, 255, 0.16)),
                linear-gradient(130deg, #f6fcff, #eaf6ff);
            border: 1px solid rgba(118, 211, 255, 0.4);
            box-shadow: 0 26px 52px rgba(11, 97, 160, 0.18);
            padding: 2.4rem;
            text-align: left;
            transition: transform var(--transition-medium), box-shadow var(--transition-medium), border-color var(--transition-medium);
        }

        .map-display-card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            padding: 1.5px;
            background: linear-gradient(140deg, rgba(79, 172, 254, 0.95), rgba(0, 198, 255, 0.85), rgba(255, 216, 240, 0.75));
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .map-display-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 32px 58px rgba(11, 97, 160, 0.24);
            border-color: rgba(87, 195, 255, 0.56);
        }

        .map-top-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.15rem;
        }

        .map-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.46rem 0.98rem;
            border-radius: var(--radius-pill);
            background: rgba(79, 172, 254, 0.14);
            color: #0e65ab;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .map-preview {
            min-height: 500px;
            border-radius: 24px;
            border: 1px solid rgba(19, 120, 194, 0.34);
            overflow: hidden;
            background: #f8f9fa;
        }

        #interactiveMap {
            width: 100%;
            height: 100%;
            min-height: 500px;
            border-radius: 24px;
        }

        .disaster-marker-popup {
            font-family: 'Poppins', sans-serif;
            min-width: 260px;
        }

        .disaster-marker-popup h4 {
            font-size: 0.95rem;
            font-weight: 700;
            margin: 0 0 0.4rem 0;
            color: #0e447d;
        }

        .disaster-marker-popup p {
            font-size: 0.85rem;
            margin: 0.3rem 0;
            color: #4f6684;
        }

        .disaster-marker-popup .disaster-type {
            background: rgba(79, 172, 254, 0.15);
            padding: 0.3rem 0.6rem;
            border-radius: 8px;
            font-weight: 600;
            color: #0e65ab;
            font-size: 0.8rem;
            display: inline-block;
            margin-top: 0.5rem;
        }

        .disaster-marker-popup .disaster-status {
            display: inline-block;
            margin-left: 0.3rem;
            padding: 0.3rem 0.6rem;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
        }

        .disaster-status.sedang-terjadi {
            background: #FF0000;
        }

        .disaster-status.selesai {
            background: #FFFFFF;
            color: #333;
            border: 1px solid #ccc;
        }

        .disaster-status.prediksi-sangat-tinggi {
            background: #d13612;
        }

        .disaster-status.prediksi-tinggi {
            background: #FFA500;
        }

        .disaster-status.prediksi-sedang {
            background: #FFD700;
            color: #333;
        }

        .disaster-status.prediksi-rendah {
            background: #9ddf59;
            color: #333;
        }

        .donate-button {
            display: inline-block;
            margin-top: 0.65rem;
            padding: 0.35rem 0.6rem;
            background: #10b981;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            border: 1px solid #0a8f66;
            font-size: 0.77rem;
        }

        .donate-button:hover {
            background: #0f8f68;
        }

        .prediction-detail {
            margin-top: 0.45rem;
            border: 1px solid rgba(0,0,0,0.08);
            background: #f8fbff;
            border-radius: 10px;
            padding: 0.45rem;
            font-size: 0.8rem;
            color: #243d71;
        }

        .prediction-progress {
            width: 100%;
            height: 8px;
            margin-top: 0.15rem;
            border-radius: 999px;
            background: rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            border-radius: 999px;
            transition: width 0.2s ease;
        }

        .prediction-note {
            margin: 0.35rem 0 0 0;
            font-size: 0.75rem;
            color: #426eb5;
            font-weight: 600;
        }

        .risk-factors {
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px solid rgba(0,0,0,0.08);
        }

        .risk-factors p {
            margin: 0 0 0.3rem 0;
            font-size: 0.75rem;
            font-weight: 600;
            color: #2c4a7c;
        }

        .risk-factors ul {
            margin: 0;
            padding-left: 1rem;
            list-style: none;
        }

        .risk-factors li {
            font-size: 0.7rem;
            color: #4a5d7a;
            margin-bottom: 0.2rem;
            position: relative;
        }

        .risk-factors li:before {
            content: '•';
            color: #4facfe;
            font-weight: bold;
            position: absolute;
            left: -0.8rem;
        }

        .leaflet-marker-icon {
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
        }

        .custom-marker-icon {
            background: none !important;
            border: none !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .custom-marker {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease;
        }

        .custom-marker-icon:hover .custom-marker {
            transform: scale(1.3);
        }

        .map-legend {
            position: absolute;
            bottom: 2rem;
            right: 1rem;
            background: white;
            padding: 1rem 1.2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            font-size: 0.85rem;
            z-index: 1000;
            max-width: 220px;
        }

        .map-legend h4 {
            margin: 0 0 0.6rem 0;
            font-weight: 700;
            color: #0e447d;
            font-size: 0.9rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin: 0.5rem 0;
            font-size: 0.82rem;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #999;
        }

        /* ============================================================
           QUICK REPORT SECTION
        ============================================================ */
        .quick-report {
            background: #ffffff;
        }

        .quick-report-card {
            border-radius: 24px;
            padding: clamp(1.4rem, 2.8vw, 2rem);
            background: linear-gradient(120deg, rgba(79, 172, 254, 0.12), rgba(0, 198, 255, 0.1));
            border: 1px solid rgba(126, 214, 255, 0.42);
            box-shadow: 0 16px 34px rgba(9, 98, 166, 0.14);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .quick-report-card h3 {
            font-size: clamp(1.35rem, 2.7vw, 1.85rem);
            margin-bottom: 0.35rem;
            color: #0f437b;
        }

        .quick-report-card p {
            color: #4e6481;
            max-width: 680px;
        }

        .btn-quick-report {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            border-radius: var(--radius-pill);
            padding: 0.95rem 1.35rem;
            color: #fff;
            font-weight: 700;
            background: linear-gradient(90deg, #2ea8ff, #0076ff);
            box-shadow: 0 12px 26px rgba(0, 118, 255, 0.3);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
        }

        .btn-quick-report:hover {
            transform: translateY(-4px);
            box-shadow: 0 17px 34px rgba(0, 118, 255, 0.38);
        }

        /* ============================================================
           EDUKASI & TIPS
        ============================================================ */
        .education {
            background: linear-gradient(145deg, #eff9ff 0%, #f7fcff 100%);
        }

        .article-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1rem;
        }

        .article-card {
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: #ffffff;
            border: 1px solid #dcf0ff;
            box-shadow: 0 12px 30px rgba(10, 103, 171, 0.1);
            transition: transform var(--transition-medium), box-shadow var(--transition-medium);
        }

        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(10, 103, 171, 0.16);
        }

        .article-image {
            position: relative;
            overflow: hidden;
            height: 210px;
            background-size: cover;
            background-position: center;
        }

        .article-image::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(130deg, rgba(11, 86, 150, 0.22), rgba(0, 198, 255, 0.1));
        }

        .article-card:hover .article-image {
            transform: scale(1.05);
            transition: transform 0.6s ease;
        }

        .article-content {
            padding: 1.2rem;
        }

        .article-content h3 {
            font-size: 1.06rem;
            margin-bottom: 0.45rem;
        }

        .article-content p {
            color: var(--text-secondary);
            font-size: 0.91rem;
            margin-bottom: 1rem;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: #0f6fb1;
            font-weight: 600;
            font-size: 0.9rem;
            transition: transform var(--transition-fast), color var(--transition-fast);
        }

        .read-more:hover {
            color: #0a588f;
            transform: translateX(3px);
        }

        /* ============================================================
           DONASI CTA SUPER MENARIK
        ============================================================ */
        .donation-cta {
            position: relative;
            overflow: hidden;
            background: linear-gradient(120deg, #42b9ff, #00c6ff, #6bc6ff);
            background-size: 220% 220%;
            animation: gradientFlow 10s ease infinite;
            color: #fff;
        }

        .donation-cta::before,
        .donation-cta::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            z-index: 0;
        }

        .donation-cta::before {
            width: 280px;
            height: 280px;
            background: rgba(255, 216, 240, 0.25);
            left: -80px;
            top: -80px;
        }

        .donation-cta::after {
            width: 260px;
            height: 260px;
            background: rgba(182, 243, 255, 0.22);
            right: -60px;
            bottom: -80px;
        }

        .donation-wrap {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 860px;
            margin-inline: auto;
        }

        .donation-wrap h2 {
            font-size: clamp(1.75rem, 4.2vw, 3rem);
            line-height: 1.2;
            margin-bottom: 1rem;
            font-weight: 800;
        }

        .donation-wrap p {
            color: rgba(255, 255, 255, 0.96);
            margin-bottom: 1.7rem;
            font-size: 1.03rem;
        }

        .btn-donate {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border-radius: var(--radius-pill);
            padding: 1rem 1.7rem;
            font-weight: 700;
            background: #ffffff;
            color: #0a68b0;
            box-shadow: 0 13px 30px rgba(9, 89, 146, 0.28);
            animation: pulseGlow 2.6s ease infinite;
            transition: transform var(--transition-fast), box-shadow var(--transition-fast);
        }

        .btn-donate:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 34px rgba(9, 89, 146, 0.36);
        }

        /* ============================================================
           FOOTER MODERN STARTUP
        ============================================================ */
        .footer {
            background: linear-gradient(145deg, #0a3c70 0%, #0d4f90 56%, #1161a9 100%);
            color: rgba(255, 255, 255, 0.95);
            padding-top: 76px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 1.8rem;
            margin-bottom: 2.2rem;
        }

        .footer h4 {
            font-size: 1.02rem;
            margin-bottom: 0.85rem;
            font-weight: 700;
        }

        .footer p,
        .footer li,
        .footer a {
            color: rgba(255, 255, 255, 0.84);
            font-size: 0.92rem;
        }

        .footer ul {
            list-style: none;
            display: grid;
            gap: 0.45rem;
        }

        .footer a:hover {
            color: #ffffff;
        }

        .social-row {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
            margin-top: 0.7rem;
        }

        .social-link {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform var(--transition-fast), background var(--transition-fast);
        }

        .social-link:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.24);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            padding: 1rem 0 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.88rem;
        }

        /* ============================================================
           FLOATING BUTTONS
        ============================================================ */
        .floating-emergency,
        .back-to-top {
            position: fixed;
            right: 22px;
            z-index: 1400;
            width: 52px;
            height: 52px;
            border: none;
            border-radius: 16px;
            display: grid;
            place-items: center;
            font-size: 1.22rem;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 12px 28px rgba(11, 72, 125, 0.28);
            transition: transform var(--transition-fast), box-shadow var(--transition-fast), opacity var(--transition-fast), visibility var(--transition-fast);
        }

        .floating-emergency {
            bottom: 88px;
            background: linear-gradient(135deg, #ff6a8b, #ff8f70);
            animation: pulseGlow 2.4s ease infinite;
        }

        .floating-emergency:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 16px 30px rgba(205, 68, 113, 0.34);
        }

        .back-to-top {
            bottom: 24px;
            background: linear-gradient(135deg, #35b5ff, #0085ff);
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .back-to-top:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 30px rgba(0, 133, 255, 0.34);
        }

        /* ============================================================
           SCROLL REVEAL ANIMATION UTIL
        ============================================================ */
        .reveal {
            opacity: 0;
            transform: translateY(26px);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }

        .reveal.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        /* ============================================================
           KEYFRAMES
        ============================================================ */
        @keyframes pageFadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes revealUp {
            from {
                opacity: 0;
                transform: translateY(26px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatingCard {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-12px);
            }
        }

        @keyframes floatSoft {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-14px);
            }
        }

        @keyframes gradientFlow {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 12px 26px rgba(8, 96, 166, 0.25);
            }
            50% {
                box-shadow: 0 0 0 10px rgba(182, 243, 255, 0.2), 0 14px 30px rgba(8, 96, 166, 0.32);
            }
        }

        /* ============================================================
           RESPONSIVE BREAKPOINTS
        ============================================================ */
        @media (min-width: 680px) {
            .logo-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .feature-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .article-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 920px) {
            .hero-grid {
                grid-template-columns: 1.05fr 0.95fr;
                gap: 1.8rem;
            }

            .logo-grid {
                grid-template-columns: repeat(5, minmax(0, 1fr));
            }

            .stats-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr));
            }

            .feature-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .status-card {
                grid-template-columns: 1.2fr auto;
            }

            .status-meta {
                justify-content: flex-end;
            }

            .article-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .footer-grid {
                grid-template-columns: 1.2fr 1fr 1fr 1fr;
            }
        }

        @media (max-width: 860px) {
            .nav-inner {
                min-height: auto;
                padding: 0.8rem 0;
                flex-direction: column;
                justify-content: center;
            }

            .nav-menu {
                gap: 0.95rem;
            }

            .nav-actions {
                margin-top: 0.25rem;
            }

            .profile-name {
                max-width: 180px;
            }

            .hero {
                padding-top: 164px;
            }
        }

        @media (max-width: 520px) {
            :root {
                --space-section: 100px;
            }

            .btn {
                width: 100%;
            }

            .hero-cta {
                width: 100%;
            }

            .floating-emergency,
            .back-to-top {
                right: 16px;
                width: 48px;
                height: 48px;
                border-radius: 14px;
            }

            .floating-emergency {
                bottom: 80px;
            }
        }
    </style>
</head>
<body id="beranda">

    <!-- ============================================================
         1) STICKY NAVBAR TRANSPARENT
    ============================================================ -->
    <header class="navbar" id="mainNavbar">
        <div class="container nav-inner">
            <a href="#beranda" class="logo gradient-text">SIAGA BENCANA</a>

            <ul class="nav-menu">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#status">Status</a></li>
                <li><a href="#peta">Peta</a></li>
                <li><a href="#edukasi">Edukasi</a></li>
                <li><a href="#donasi">Donasi</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>

            <div class="nav-actions">
                @guest
                    <a href="{{ route('login') }}" class="btn-login-admin">
                        <i class="fa-solid fa-user-shield"></i>
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-register">
                        <i class="fa-solid fa-user-plus"></i>
                        Daftar
                    </a>
                @endguest

                @auth
                    @php
                        $authUser = Auth::user();
                        $avatarUrl = $authUser->getAttribute('avatar') ?? $authUser->getAttribute('photo') ?? null;
                        $nameParts = preg_split('/\s+/', trim($authUser->name ?? 'User'));
                        $initials = strtoupper(
                            mb_substr($nameParts[0] ?? 'U', 0, 1)
                            . mb_substr($nameParts[1] ?? '', 0, 1)
                        );
                    @endphp

                    <div class="profile-dropdown-wrap" data-profile-dropdown>
                        <button type="button" class="profile-trigger" data-profile-toggle aria-expanded="false" aria-haspopup="true">
                            @if ($avatarUrl)
                                <img src="{{ $avatarUrl }}" alt="Avatar {{ $authUser->name }}" class="profile-avatar">
                            @else
                                <span class="profile-avatar--fallback">{{ $initials }}</span>
                            @endif
                            <span class="profile-name">{{ $authUser->name }}</span>
                            <i class="fa-solid fa-chevron-down profile-chevron"></i>
                        </button>

                        <div class="profile-dropdown" data-profile-menu>
                            <a href="{{ route('profile.edit') }}" class="profile-menu-item">
                                <i class="fa-regular fa-user"></i>
                                Profil Saya
                            </a>
                
                            <div class="profile-menu-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="profile-menu-item profile-logout">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </header>

    <!-- ============================================================
         2) HERO SECTION SUPER STARTUP
    ============================================================ -->
    <section class="hero">
        <div class="container hero-grid">

            <div class="hero-text">
                <h1>Platform Digital Monitoring &amp; Siaga Bencana Indonesia</h1>
                <p>
                    Sistem terintegrasi untuk pemantauan bencana real-time, koordinasi relawan,
                    edukasi mitigasi, dan bantuan cepat agar setiap masyarakat dapat merespons lebih
                    tepat dan lebih aman.
                </p>

                <div class="hero-cta">
                    <a href="#peta" class="btn btn-primary">
                        <i class="fa-solid fa-bolt"></i>
                        Pantau Peta Bencana
                    </a>
                    <a href="#fitur" class="btn btn-secondary">
                        <i class="fa-solid fa-circle-info"></i>
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <div class="hero-visual">
                <div class="hero-visual-card">
                    <div class="visual-main-icon">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <h3 class="visual-title">Siaga 24/7</h3>
                    <p class="visual-subtitle">Notifikasi dini, dashboard status, dan koordinasi bantuan dalam satu platform.</p>
                </div>

                <span class="floating-mini fm-1"><i class="fa-solid fa-house-crack"></i></span>
                <span class="floating-mini fm-2"><i class="fa-solid fa-cloud-bolt"></i></span>
                <span class="floating-mini fm-3"><i class="fa-solid fa-triangle-exclamation"></i></span>
            </div>
        </div>

        <div class="hero-wave" aria-hidden="true">
            <svg viewBox="0 0 1440 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="#ffffff" d="M0,96L48,85.3C96,75,192,53,288,53.3C384,53,480,75,576,80C672,85,768,75,864,58.7C960,43,1056,21,1152,26.7C1248,32,1344,64,1392,80L1440,96L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
            </svg>
        </div>
    </section>

    <!-- ============================================================
         3) PETA INTERAKTIF (MAIN FEATURE)
    ============================================================ -->
    <section class="map-section section-padding reveal" id="peta">
        <div class="map-main-wrap">
            <div class="section-heading">
                <span class="tag">Fitur Utama</span>
                <h2 class="map-main-heading">Peta Bencana Jawa Timur</h2>
                <p class="map-main-description">Pantau lokasi bencana secara visual dan real-time.</p>
            </div>

            <div class="map-display-card">
                <div class="map-top-meta">
                    <span class="map-badge"><i class="fa-solid fa-satellite-dish"></i> Live Monitoring Map</span>
                    <span class="map-badge"><i class="fa-solid fa-layer-group"></i> Integrasi Marker Dinamis</span>
                </div>

                <div class="map-preview" id="mapContainer">
                    <div id="interactiveMap"></div>
                    <div class="map-legend">
                        <h4>Legenda Status</h4>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #FF0000;"></div>
                            <span>Bencana Terjadi</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #d13612;"></div>
                            <span>Prediksi Sangat Tinggi (≥75%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #FFA500;"></div>
                            <span>Prediksi Tinggi (50-74%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #FFD700;"></div>
                            <span>Prediksi Sedang (30-49%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #9ddf59;"></div>
                            <span>Prediksi Rendah (&lt;30%)</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #FFFFFF; border: 2px solid #999;"></div>
                            <span>Bencana Selesai</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         4) STATUS BENCANA TERKINI
    ============================================================ -->
    <section class="status-section section-padding reveal" id="status">
        <div class="container">
            <div class="section-heading">
                <span class="tag">Update Terkini</span>
                <h2>Status Bencana Saat Ini</h2>
                <p>Informasi terbaru dari beberapa wilayah prioritas untuk memudahkan kesiapsiagaan komunitas.</p>
            </div>

            <div class="status-list">
                <article class="status-card">
                    <div class="status-left">
                        <div class="status-icon"><i class="fa-solid fa-house-crack"></i></div>
                        <div class="status-info">
                            <h3>Gempa Bumi - Jawa Barat</h3>
                            <p>Magnitudo sedang, pemantauan intensif dan pemeriksaan bangunan vital dilakukan.</p>
                        </div>
                    </div>
                    <div class="status-meta">
                        <span class="badge badge-siaga"><i class="fa-solid fa-circle"></i> Siaga</span>
                        <a href="#" class="btn-detail">Detail <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="status-card">
                    <div class="status-left">
                        <div class="status-icon"><i class="fa-solid fa-water"></i></div>
                        <div class="status-info">
                            <h3>Banjir - Kalimantan Selatan</h3>
                            <p>Ketinggian air mulai naik di beberapa kecamatan, tim evakuasi sudah disiagakan.</p>
                        </div>
                    </div>
                    <div class="status-meta">
                        <span class="badge badge-waspada"><i class="fa-solid fa-circle"></i> Waspada</span>
                        <a href="#" class="btn-detail">Detail <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="status-card">
                    <div class="status-left">
                        <div class="status-icon"><i class="fa-solid fa-mountain-city"></i></div>
                        <div class="status-info">
                            <h3>Gunung Meletus - Nusa Tenggara</h3>
                            <p>Aktivitas vulkanik stabil dengan radius aman diperluas berdasarkan laporan terbaru.</p>
                        </div>
                    </div>
                    <div class="status-meta">
                        <span class="badge badge-aman"><i class="fa-solid fa-circle"></i> Aman</span>
                        <a href="#" class="btn-detail">Detail <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ============================================================
         5) QUICK REPORT
    ============================================================ -->
    <section class="quick-report section-padding reveal">
        <div class="container">
            <div class="quick-report-card">
                <div>
                    <h3>Laporan Cepat Kejadian Bencana</h3>
                    <p>Kirim laporan langsung dari lapangan agar tim tanggap darurat dapat memverifikasi dan menindaklanjuti lebih cepat.</p>
                </div>
                <a href="{{ route('reports.index') }}" class="btn-quick-report">
                    <i class="fa-solid fa-paper-plane"></i>
                    Buat Laporan
                </a>
            </div>
        </div>
    </section>

    <!-- ============================================================
         6) TRUSTED / SOCIAL PROOF SECTION
    ============================================================ -->
    <section class="trusted reveal">
        <div class="container">
            <p>Dipercaya oleh Relawan &amp; Instansi</p>
            <div class="logo-grid">
                <div class="logo-box">LOGO 01</div>
                <div class="logo-box">LOGO 02</div>
                <div class="logo-box">LOGO 03</div>
                <div class="logo-box">LOGO 04</div>
                <div class="logo-box">LOGO 05</div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         4) STATISTIK SECTION (CARD MODERN)
    ============================================================ -->
    <section class="stats section-padding reveal" id="stats">
        <div class="container">
            <div class="section-heading">
                <span class="tag">Statistik Nasional</span>
                <h2 class="gradient-text">Data Monitoring Bencana Terkini</h2>
                <p>Ringkasan angka penting untuk membantu pengambilan keputusan cepat dan koordinasi lintas tim.</p>
            </div>

            <div class="stats-grid">
                <article class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-house-crack"></i></div>
                    </div>
                    <p class="stat-label">Total Bencana</p>
                    <h3 class="stat-number" data-counter="1287">0</h3>
                    <p class="stat-note">Kejadian tercatat sepanjang tahun ini</p>
                </article>

                <article class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    </div>
                    <p class="stat-label">Bencana Aktif</p>
                    <h3 class="stat-number" data-counter="76">0</h3>
                    <p class="stat-note">Lokasi status siaga atau tanggap darurat</p>
                </article>

                <article class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-people-group"></i></div>
                    </div>
                    <p class="stat-label">Relawan Terdaftar</p>
                    <h3 class="stat-number" data-counter="54210">0</h3>
                    <p class="stat-note">Jaringan relawan aktif lintas wilayah</p>
                </article>

                <article class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                    </div>
                    <p class="stat-label">Total Donasi</p>
                    <h3 class="stat-number" data-counter="964">0</h3>
                    <p class="stat-note">Miliar rupiah tersalurkan secara transparan</p>
                </article>
            </div>
        </div>
    </section>

    <!-- ============================================================
         5) FITUR UNGGULAN (GRID MODERN)
    ============================================================ -->
    <section class="features section-padding reveal" id="fitur">
        <div class="container">
            <div class="section-heading">
                <span class="tag">Fitur Unggulan</span>
                <h2>Teknologi Siaga untuk Respons Lebih Cepat</h2>
                <p>Dirancang untuk komunitas, relawan, dan instansi agar kolaborasi bencana berjalan real-time.</p>
            </div>

            <div class="feature-grid">
                <a href="#" class="block h-full focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sky-400/70 rounded-2xl">
                    <div class="feature-card h-full rounded-2xl text-center cursor-pointer transition duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl">
                        <div class="feature-icon mx-auto"><i class="fa-solid fa-bell"></i></div>
                        <h3>Peringatan Dini</h3>
                        <p>Notifikasi otomatis berbasis lokasi untuk peringatan bencana dan level ancaman terbaru.</p>
                    </div>
                </a>

                <a href="{{ route('reports.index') }}" class="block h-full focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sky-400/70 rounded-2xl">
                    <div class="feature-card h-full rounded-2xl text-center cursor-pointer transition duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl">
                        <div class="feature-icon mx-auto"><i class="fa-solid fa-paper-plane"></i></div>
                        <h3>Laporan Cepat</h3>
                        <p>Masyarakat dapat mengirim laporan lapangan lengkap dengan foto dan titik koordinat.</p>
                    </div>
                </a>

                <a href="#" class="block h-full focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sky-400/70 rounded-2xl">
                    <div class="feature-card h-full rounded-2xl text-center cursor-pointer transition duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl">
                        <div class="feature-icon mx-auto"><i class="fa-solid fa-chart-line"></i></div>
                        <h3>Data Real-time</h3>
                        <p>Dashboard analitik kejadian bencana, tren risiko, dan performa respons secara langsung.</p>
                    </div>
                </a>

                <a href="#" class="block h-full focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sky-400/70 rounded-2xl">
                    <div class="feature-card h-full rounded-2xl text-center cursor-pointer transition duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl">
                        <div class="feature-icon mx-auto"><i class="fa-solid fa-map-location-dot"></i></div>
                        <h3>Peta Interaktif</h3>
                        <p>Visualisasi area terdampak, titik pengungsian, dan jalur evakuasi dalam satu tampilan.</p>
                    </div>
                </a>

                <a href="#donasi" class="block h-full focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-sky-400/70 rounded-2xl">
                    <div class="feature-card h-full rounded-2xl text-center cursor-pointer transition duration-300 ease-in-out hover:-translate-y-2 hover:shadow-2xl">
                        <div class="feature-icon mx-auto"><i class="fa-solid fa-wallet"></i></div>
                        <h3>Donasi Transparan</h3>
                        <p>Pelacakan dana donasi, progres penyaluran, dan laporan penggunaan secara terbuka.</p>
                    </div>
                </a>

            </div>
        </div>
    </section>

    <!-- ============================================================
         8) EDUKASI & TIPS
    ============================================================ -->
    <section class="education section-padding reveal" id="edukasi">
        <div class="container">
            <div class="section-heading">
                <span class="tag">Edukasi Masyarakat</span>
                <h2>Tips Mitigasi &amp; Kesiapsiagaan</h2>
                <p>Panduan praktis agar setiap keluarga siap menghadapi kondisi darurat dengan lebih tenang.</p>
            </div>

            <div class="article-grid">
                <article class="article-card">
                    <div class="article-image" style="background-image: linear-gradient(130deg, #4facfe, #00c6ff);"></div>
                    <div class="article-content">
                        <h3>Checklist Tas Siaga 72 Jam</h3>
                        <p>Susun perlengkapan wajib yang harus tersedia agar keluarga siap saat evakuasi darurat.</p>
                        <a href="#" class="read-more">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-image" style="background-image: linear-gradient(130deg, #64d8ff, #38bdf8);"></div>
                    <div class="article-content">
                        <h3>Panduan Evakuasi Gempa Aman</h3>
                        <p>Langkah cepat melindungi diri saat gempa di rumah, kantor, sekolah, dan ruang publik.</p>
                        <a href="#" class="read-more">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="article-card">
                    <div class="article-image" style="background-image: linear-gradient(130deg, #53c3ff, #70d6ff);"></div>
                    <div class="article-content">
                        <h3>Membaca Status Peringatan Dini</h3>
                        <p>Pahami arti level aman, waspada, dan siaga agar tindakan evakuasi lebih tepat waktu.</p>
                        <a href="#" class="read-more">Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ============================================================
         9) DONASI SECTION CTA SUPER MENARIK
    ============================================================ -->
    <section class="donation-cta section-padding reveal" id="donasi">
        <div class="container donation-wrap">
            <h2>Bersama Kita Bisa Menyelamatkan Lebih Banyak Nyawa</h2>
            <p>
                Setiap dukungan Anda membantu tim relawan menyalurkan logistik, layanan medis,
                dan perlindungan bagi warga terdampak di berbagai wilayah Indonesia.
            </p>
            <a href="#" class="btn-donate">
                <i class="fa-solid fa-heart"></i>
                Donasi Sekarang
            </a>
        </div>
    </section>

    <!-- ============================================================
         10) FOOTER MODERN STARTUP
    ============================================================ -->
    <footer class="footer" id="kontak">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <h4>Tentang</h4>
                    <p>SIAGA BENCANA adalah platform digital kolaboratif untuk memperkuat monitoring, mitigasi, dan respons bencana di Indonesia.</p>
                </div>

                <div>
                    <h4>Navigasi</h4>
                    <ul>
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#status">Status Bencana</a></li>
                        <li><a href="#peta">Peta Interaktif</a></li>
                        <li><a href="#edukasi">Edukasi</a></li>
                        <li><a href="#donasi">Donasi</a></li>
                    </ul>
                </div>

                <div>
                    <h4>Kontak</h4>
                    <ul>
                        <li>Email: info@siagabencana.id</li>
                        <li>Hotline: 021-1234-5678</li>
                        <li>Jakarta, Indonesia</li>
                    </ul>
                </div>

                <div>
                    <h4>Sosial Media</h4>
                    <p>Ikuti update dan edukasi terbaru melalui kanal resmi kami.</p>
                    <div class="social-row">
                        <a href="#" class="social-link" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social-link" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="social-link" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="social-link" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                © 2026 SIAGA BENCANA. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- ============================================================
         FLOATING EMERGENCY BUTTON
    ============================================================ -->
    <a href="#" class="floating-emergency" aria-label="Emergency Call">
        <i class="fa-solid fa-phone"></i>
    </a>

    <!-- ============================================================
         BACK TO TOP BUTTON
    ============================================================ -->
    <button class="back-to-top" id="backToTop" aria-label="Back to Top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- ============================================================
         INTERACTION SCRIPTS:
         - Navbar scroll background
         - Scroll reveal animation
         - Back to top visibility
         - Counter animation saat scroll
    ============================================================ -->
    <script>
        // Map Initialization and Disaster Real-time Data
        let map = null;
        let markers = {};
        let updateInterval = null;

        function initializeMap() {
            if (!map) {
                console.log('Initializing map...');
                // Center pada Jawa (-7.0726, 110.3927)
                map = L.map('interactiveMap').setView([-7.0726, 110.3927], 8);

                // Satellite imagery dari ESRI
                L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: '© ESRI, DigitalGlobe, GeoEye, Earthstar Geographics',
                    maxZoom: 19,
                    minZoom: 6
                }).addTo(map);
                
                console.log('Map initialized successfully');
            }
        }

        function getMarkerColor(disaster) {
            if (disaster.status === 'Terjadi') {
                return '#FF0000'; // Merah untuk bencana sedang terjadi
            } else if (disaster.status === 'Selesai') {
                return '#FFFFFF'; // Putih untuk bencana selesai
            }

            // Prediksi: beri gradien warna berdasarkan level risiko
            if (disaster.prediction >= 75) {
                return '#d13612'; // Merah gelap untuk prediksi sangat tinggi
            } else if (disaster.prediction >= 50) {
                return '#FFA500'; // Orange untuk prediksi tinggi
            } else if (disaster.prediction >= 30) {
                return '#FFD700'; // Kuning untuk prediksi sedang
            } else {
                return '#9ddf59'; // Hijau muda untuk prediksi rendah
            }
        }

        function getPredictionRisk(disaster) {
            const baseRisk = {
                prediction: disaster.prediction,
                type: disaster.type,
                location: disaster.location
            };

            let factors = [];

            // Faktor berdasarkan jenis bencana
            if (disaster.type === 'Gempa Bumi') {
                factors = [
                    'Aktivitas seismik tinggi di zona patahan',
                    'Riwayat gempa bumi signifikan',
                    'Kedalaman hiposenter dangkal',
                    'Tren peningkatan aktivitas tektonik'
                ];
            } else if (disaster.type === 'Banjir') {
                factors = [
                    'Curah hujan ekstrem dalam 24 jam',
                    'Luapan sungai dan drainase buruk',
                    'Ketinggian air di atas normal',
                    'Luas area genangan bertambah'
                ];
            } else if (disaster.type === 'Tanah Longsor') {
                factors = [
                    'Kemiringan lereng >30 derajat',
                    'Curah hujan intensif berkepanjangan',
                    'Kondisi tanah jenuh air',
                    'Vegetasi penutup tanah berkurang'
                ];
            } else if (disaster.type === 'Tsunami') {
                factors = [
                    'Gempa bawah laut magnitude tinggi',
                    'Lokasi epikenter dekat pantai',
                    'Kedalaman laut dangkal',
                    'Potensi gelombang tinggi'
                ];
            } else {
                factors = [
                    'Kondisi cuaca ekstrem',
                    'Faktor geografis lokal',
                    'Aktivitas vulkanik',
                    'Perubahan iklim regional'
                ];
            }

            // Penyesuaian berdasarkan persentase
            if (disaster.prediction >= 75) {
                return {
                    label: 'Sangat Tinggi',
                    className: 'prediksi-sangat-tinggi',
                    factors: factors,
                    recommendation: 'Evakuasi segera, siapkan rencana darurat'
                };
            } else if (disaster.prediction >= 50) {
                return {
                    label: 'Tinggi',
                    className: 'prediksi-tinggi',
                    factors: factors,
                    recommendation: 'Waspada tinggi, siapkan evakuasi'
                };
            } else if (disaster.prediction >= 30) {
                return {
                    label: 'Sedang',
                    className: 'prediksi-sedang',
                    factors: factors,
                    recommendation: 'Monitor terus, siap siaga'
                };
            } else {
                return {
                    label: 'Rendah',
                    className: 'prediksi-rendah',
                    factors: factors,
                    recommendation: 'Tetap waspada, pantau perkembangan'
                };
            }
        }

        function getMarkerIcon(color) {
            const html = `
                <div class="custom-marker" style="background-color: ${color}; width: 24px; height: 24px; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 0 0 2px #333, 0 3px 8px rgba(0,0,0,0.5);"></div>
            `;
            return L.divIcon({
                html: html,
                iconSize: [32, 32],
                iconAnchor: [16, 16],
                popupAnchor: [0, -16],
                className: 'custom-marker-icon'
            });
        }

        function createPopupContent(disaster) {
            let statusClass = '';
            let statusText = '';
            let extraStatusHtml = '';

            if (disaster.status === 'Terjadi') {
                statusClass = 'sedang-terjadi';
                statusText = 'SEDANG TERJADI';
                extraStatusHtml = '<p><strong>Status:</strong> Respon darurat dibutuhkan segera</p>';
            } else if (disaster.status === 'Selesai') {
                statusClass = 'selesai';
                statusText = 'SELESAI';
                extraStatusHtml = '<p><strong>Status:</strong> Situasi terkendali</p>';
            } else {
                const risk = getPredictionRisk(disaster);
                statusClass = risk.className;
                statusText = `PREDIKSI ${risk.label}`;
                extraStatusHtml = `
                    <div class="prediction-detail">
                        <p><strong>Probabilitas:</strong> ${disaster.prediction}%</p>
                        <div class="prediction-progress">
                            <div class="progress-bar" style="width: ${Math.max(6, disaster.prediction)}%; background: ${getMarkerColor(disaster)};"></div>
                        </div>
                        <p class="prediction-note">${risk.recommendation}</p>
                        <div class="risk-factors">
                            <p><strong>Faktor Risiko:</strong></p>
                            <ul>
                                ${risk.factors.map(factor => `<li>${factor}</li>`).join('')}
                            </ul>
                        </div>
                    </div>
                `;
            }

            const donateButton = disaster.status === 'Selesai' ? `<a class="donate-button" href="/reports/${disaster.id}/donate" target="_blank" rel="noopener">Donasi Sekarang</a>` : '';

            return `
                <div class="disaster-marker-popup">
                    <h4>${disaster.title}</h4>
                    <p><strong>Tipe:</strong> ${disaster.type}</p>
                    <p><strong>Lokasi:</strong> ${disaster.location}</p>
                    <p><strong>Tanggal:</strong> ${disaster.date}</p>
                    <p><strong>Deskripsi:</strong> ${disaster.description}</p>
                    ${extraStatusHtml}
                    <div style="margin-top:0.5rem; display:grid; grid-template-columns:1fr auto; gap:0.4rem; align-items:center;">
                        <span class="disaster-type">${disaster.type}</span>
                        <span class="disaster-status ${statusClass}">${statusText}</span>
                    </div>
                    ${donateButton}
                </div>
            `;
        }

        function loadDisasterData() {
            fetch('/api/disaster-data')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(disasters => {
                    console.log('Disasters loaded:', disasters);
                    
                    // Clear old markers
                    Object.keys(markers).forEach(key => {
                        map.removeLayer(markers[key]);
                    });
                    markers = {};

                    if (disasters.length === 0) {
                        console.warn('No disaster data received from API');
                        return;
                    }

                    // Add new markers
                    disasters.forEach(disaster => {
                        console.log('Adding marker for:', disaster.title, 'Color:', disaster.status);
                        const color = getMarkerColor(disaster);
                        console.log('Final color:', color);
                        const icon = getMarkerIcon(color);

                        const marker = L.marker([disaster.lat, disaster.lng], { icon: icon })
                            .addTo(map)
                            .bindPopup(createPopupContent(disaster));

                        markers[disaster.id] = marker;
                    });
                    
                    console.log('Total markers added:', Object.keys(markers).length);
                })
                .catch(error => console.error('Error loading disaster data:', error));
        }

        function startRealTimeUpdates() {
            // Load immediately on page load
            loadDisasterData();

            // Update setiap 5 detik untuk real-time data
            updateInterval = setInterval(loadDisasterData, 5000);
        }

        function stopRealTimeUpdates() {
            if (updateInterval) {
                clearInterval(updateInterval);
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Check if map container is visible
            const mapContainer = document.getElementById('mapContainer');
            if (mapContainer) {
                initializeMap();
                startRealTimeUpdates();
            }
        });

        // Stop updates when page is hidden to save bandwidth
        document.addEventListener('visibility-change', function() {
            if (document.hidden) {
                stopRealTimeUpdates();
            } else if (map) {
                startRealTimeUpdates();
            }
        });

        (function () {
            const navbar = document.getElementById('mainNavbar');
            const backToTopBtn = document.getElementById('backToTop');
            const revealElements = document.querySelectorAll('.reveal');
            const counterElements = document.querySelectorAll('[data-counter]');
            const profileDropdownWrap = document.querySelector('[data-profile-dropdown]');
            const profileToggle = document.querySelector('[data-profile-toggle]');
            let counterTriggered = false;

            function closeProfileDropdown() {
                if (!profileDropdownWrap || !profileToggle) {
                    return;
                }

                profileDropdownWrap.classList.remove('is-open');
                profileToggle.setAttribute('aria-expanded', 'false');
            }

            function toggleProfileDropdown() {
                if (!profileDropdownWrap || !profileToggle) {
                    return;
                }

                const isOpen = profileDropdownWrap.classList.toggle('is-open');
                profileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            }

            function updateNavbarAndButtons() {
                const scrollY = window.scrollY;

                if (scrollY > 24) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                if (scrollY > 280) {
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                }
            }

            function revealOnScroll() {
                revealElements.forEach((element) => {
                    const triggerPoint = window.innerHeight * 0.9;
                    const elementTop = element.getBoundingClientRect().top;

                    if (elementTop < triggerPoint) {
                        element.classList.add('in-view');
                    }
                });
            }

            function animateCounter(element, endValue, duration = 1800) {
                let startValue = 0;
                const startTime = performance.now();

                function update(currentTime) {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const easeOut = 1 - Math.pow(1 - progress, 3);
                    const value = Math.floor(startValue + (endValue - startValue) * easeOut);

                    element.textContent = value.toLocaleString('id-ID');

                    if (progress < 1) {
                        requestAnimationFrame(update);
                    }
                }

                requestAnimationFrame(update);
            }

            function triggerCounters() {
                if (counterTriggered) {
                    return;
                }

                const statsSection = document.getElementById('status');
                if (!statsSection) {
                    return;
                }

                const sectionTop = statsSection.getBoundingClientRect().top;
                const triggerPoint = window.innerHeight * 0.85;

                if (sectionTop < triggerPoint) {
                    counterTriggered = true;

                    counterElements.forEach((counterElement) => {
                        const rawValue = counterElement.getAttribute('data-counter') || '0';
                        const endValue = Number.parseInt(rawValue, 10) || 0;
                        animateCounter(counterElement, endValue);
                    });
                }
            }

            window.addEventListener('scroll', function () {
                updateNavbarAndButtons();
                revealOnScroll();
                triggerCounters();
            });

            if (profileToggle) {
                profileToggle.addEventListener('click', function (event) {
                    event.stopPropagation();
                    toggleProfileDropdown();
                });

                document.addEventListener('click', function (event) {
                    if (!profileDropdownWrap.contains(event.target)) {
                        closeProfileDropdown();
                    }
                });

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        closeProfileDropdown();
                    }
                });
            }

            backToTopBtn.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            updateNavbarAndButtons();
            revealOnScroll();
            triggerCounters();
        })();
    </script>
</body>
</html>