<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register | Siaga Bencana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Sora', sans-serif;
        }

        .auth-bg {
            background: linear-gradient(145deg, #032447 0%, #0b4f88 40%, #26b9cb 100%);
            position: relative;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 9999px;
            background: rgba(255, 255, 255, 0.2);
            pointer-events: none;
            animation: floaty 9s ease-in-out infinite;
        }

        .slide-up {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 650ms ease, transform 650ms cubic-bezier(0.22, 1, 0.36, 1);
        }

        .loaded .slide-up {
            opacity: 1;
            transform: translateY(0);
        }

        .input-anim {
            transition: all 230ms ease;
        }

        .input-anim:focus {
            transform: translateY(-1px);
            box-shadow: 0 0 0 4px rgba(34, 211, 238, 0.14);
        }

        .glow-btn {
            transition: transform 220ms ease, box-shadow 260ms ease;
        }

        .glow-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 0 6px rgba(56, 189, 248, 0.15), 0 16px 32px rgba(2, 132, 199, 0.35);
        }

        @keyframes floaty {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-18px) translateX(10px); }
        }
    </style>
</head>
<body class="auth-bg min-h-screen text-slate-900">
    <span class="shape w-44 h-44 -top-10 left-10"></span>
    <span class="shape w-32 h-32 right-12 bottom-16" style="animation-delay: .8s;"></span>

    <main class="relative z-10 min-h-screen flex items-center justify-center px-5 py-10">
        <section class="slide-up w-full max-w-lg rounded-3xl border border-white/45 bg-white/90 p-8 sm:p-10 shadow-2xl shadow-cyan-950/25 backdrop-blur-xl">
            <div class="mb-7 text-center">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-cyan-700">Siaga Bencana</p>
                <h1 class="mt-2 text-3xl font-extrabold text-slate-900">Buat Akun Baru</h1>
                <p class="mt-2 text-sm text-slate-600">Gabung untuk memantau informasi bencana dan koordinasi bantuan.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="mb-1.5 block text-sm font-semibold text-slate-700">Nama</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        class="input-anim block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-cyan-500"
                        placeholder="Nama lengkap"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="username"
                        class="input-anim block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-cyan-500"
                        placeholder="nama@email.com"
                    >
                    @error('email')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="mb-1.5 block text-sm font-semibold text-slate-700">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="input-anim block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-cyan-500"
                        placeholder="Minimal 8 karakter"
                    >
                    @error('password')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="mb-1.5 block text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="input-anim block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-cyan-500"
                        placeholder="Ulangi password"
                    >
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="glow-btn w-full rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-700/30">
                    Register
                </button>

                <p class="text-center text-sm text-slate-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-cyan-700 transition hover:text-cyan-500">Login di sini</a>
                </p>
            </form>
        </section>
    </main>

    <script>
        window.addEventListener('load', function () {
            document.body.classList.add('loaded');
        });
    </script>
</body>
</html>
