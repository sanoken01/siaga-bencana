<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | Siaga Bencana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Sora', sans-serif;
        }

        .auth-bg {
            background: linear-gradient(135deg, #06234a 0%, #0f4f99 45%, #16a8d7 100%);
            position: relative;
            overflow: hidden;
        }

        .auth-bg::before,
        .auth-bg::after {
            content: '';
            position: absolute;
            border-radius: 9999px;
            filter: blur(2px);
            opacity: 0.45;
            animation: floatBlob 12s ease-in-out infinite;
        }

        .auth-bg::before {
            width: 22rem;
            height: 22rem;
            top: -8rem;
            left: -6rem;
            background: #6de6ff;
        }

        .auth-bg::after {
            width: 18rem;
            height: 18rem;
            right: -4rem;
            bottom: -5rem;
            background: #d0f7ff;
            animation-delay: 1.5s;
        }

        .floating-shape {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
            background: rgba(255, 255, 255, 0.16);
            animation: floatSoft 8s ease-in-out infinite;
        }

        .card-in {
            opacity: 0;
            transform: translateY(14px) scale(0.98);
            transition: all 600ms cubic-bezier(0.22, 1, 0.36, 1);
        }

        .page-loaded .card-in {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .input-anim {
            transition: all 220ms ease;
        }

        .input-anim:focus {
            transform: translateY(-1px);
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.16);
        }

        .btn-login {
            transition: transform 200ms ease, box-shadow 220ms ease, filter 220ms ease;
        }

        .btn-login:hover {
            transform: scale(1.03);
            box-shadow: 0 14px 34px rgba(2, 132, 199, 0.38);
            filter: brightness(1.04);
        }

        @keyframes floatBlob {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-16px); }
        }

        @keyframes floatSoft {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(12px, -18px); }
        }
    </style>
</head>
<body class="auth-bg min-h-screen text-slate-900">
    <span class="floating-shape h-40 w-40 top-24 right-[22%]"></span>
    <span class="floating-shape h-28 w-28 bottom-16 left-[18%]" style="animation-delay: 1s;"></span>

    <main class="relative z-10 min-h-screen flex items-center justify-center px-5 py-10">
        <section class="card-in w-full max-w-md rounded-3xl border border-white/50 bg-white/90 backdrop-blur-xl shadow-2xl shadow-cyan-950/25 p-8 sm:p-10">
            <div class="mb-7 text-center">
                <p class="text-xs font-semibold uppercase tracking-[0.28em] text-cyan-700">Siaga Bencana</p>
                <h1 class="mt-2 text-3xl font-extrabold text-slate-900">Selamat Datang Kembali</h1>
                <p class="mt-2 text-sm text-slate-600">Masuk untuk memantau kondisi bencana secara real-time.</p>
            </div>

            <x-auth-session-status class="mb-4 text-sm text-emerald-700" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-semibold text-slate-700">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
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
                    <div class="relative">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            class="input-anim block w-full rounded-xl border border-slate-200 bg-white px-4 py-3 pr-12 text-sm outline-none focus:border-cyan-500"
                            placeholder="Masukkan password"
                        >
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 text-xs font-semibold text-cyan-700">Tampil</button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label for="remember" class="inline-flex items-center gap-2 text-slate-600">
                        <input id="remember" name="remember" type="checkbox" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                        Ingat saya
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-medium text-cyan-700 transition hover:text-cyan-500">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn-login w-full rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-cyan-700/30">
                    Login
                </button>

                <p class="text-center text-sm text-slate-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-cyan-700 transition hover:text-cyan-500">Daftar sekarang</a>
                </p>
            </form>
        </section>
    </main>

    <script>
        window.addEventListener('load', function () {
            document.body.classList.add('page-loaded');
        });

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            togglePassword.textContent = isPassword ? 'Sembunyi' : 'Tampil';
        });
    </script>
</body>
</html>
