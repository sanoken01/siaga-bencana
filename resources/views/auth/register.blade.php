<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Register | Siaga Bencana</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer">
	<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
	<main class="auth-page">
		<div class="auth-container">
			<section class="left-panel">
				<div>
					<span class="left-panel__brand">
						<i class="fa-solid fa-wave-square"></i>
						Siaga Bencana
					</span>
					<h1 class="left-panel__title">Buat akun untuk mulai memantau informasi bencana dan koordinasi bantuan.</h1>
					<p class="left-panel__desc">
						Registrasi cepat untuk mengakses sistem pelaporan, monitoring wilayah, dan kolaborasi respon secara real-time.
					</p>
				</div>

				<p class="left-panel__meta">
					Desain autentikasi dibuat modern dan clean agar pengalaman pertama pengguna terasa profesional seperti produk SaaS.
				</p>
			</section>

			<section class="form-panel">
				<a class="auth-back" href="{{ url('/') }}">
					<i class="fa-solid fa-arrow-left"></i>
					Kembali ke beranda
				</a>

				<h2 class="form-title">Register</h2>
				<p class="form-subtitle">Lengkapi data berikut untuk membuat akun baru.</p>

				<form method="POST" action="{{ route('register') }}">
					@csrf

					<div class="form-group">
						<label for="name" class="form-label">Nama</label>
						<div class="input-wrap">
							<span class="input-icon"><i class="fa-regular fa-user"></i></span>
							<input
								id="name"
								type="text"
								name="name"
								value="{{ old('name') }}"
								required
								autofocus
								autocomplete="name"
								class="form-input @error('name') is-invalid @enderror"
								placeholder="Nama lengkap"
							>
						</div>
						@error('name')
							<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label for="email" class="form-label">Email</label>
						<div class="input-wrap">
							<span class="input-icon"><i class="fa-regular fa-envelope"></i></span>
							<input
								id="email"
								type="email"
								name="email"
								value="{{ old('email') }}"
								required
								autocomplete="username"
								class="form-input @error('email') is-invalid @enderror"
								placeholder="nama@email.com"
							>
						</div>
						@error('email')
							<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label for="password" class="form-label">Password</label>
						<div class="input-wrap">
							<span class="input-icon"><i class="fa-solid fa-lock"></i></span>
							<input
								id="password"
								type="password"
								name="password"
								required
								autocomplete="new-password"
								class="form-input @error('password') is-invalid @enderror"
								placeholder="Minimal 8 karakter"
								style="padding-right: 44px;"
							>
							<button type="button" class="password-toggle" data-toggle-password data-target="password" aria-label="Tampilkan password">
								<i class="fa-regular fa-eye"></i>
							</button>
						</div>
						@error('password')
							<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</p>
						@enderror
					</div>

					<div class="form-group">
						<label for="password_confirmation" class="form-label">Confirm Password</label>
						<div class="input-wrap">
							<span class="input-icon"><i class="fa-solid fa-lock"></i></span>
							<input
								id="password_confirmation"
								type="password"
								name="password_confirmation"
								required
								autocomplete="new-password"
								class="form-input @error('password_confirmation') is-invalid @enderror"
								placeholder="Ulangi password"
								style="padding-right: 44px;"
							>
							<button type="button" class="password-toggle" data-toggle-password data-target="password_confirmation" aria-label="Tampilkan konfirmasi password">
								<i class="fa-regular fa-eye"></i>
							</button>
						</div>
						@error('password_confirmation')
							<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>{{ $message }}</p>
						@enderror
					</div>

					<button type="submit" class="form-button">Register</button>

					<p class="form-footer">
						Sudah punya akun?
						<a href="{{ route('login') }}">Login</a>
					</p>
				</form>
			</section>
		</div>
	</main>

	<script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
