<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Manajemen Laporan Bencana</title>

	<!-- =======================
		 Google Font: Poppins
	======================== -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

	<!-- =======================
		 Font Awesome CDN
	======================== -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<style>
		/* =======================
		   CSS RESET & BASE
		======================== */
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
			--text-dark: #0d1b2a;
			--text-muted: #6b7a90;
			--white: #ffffff;
			--surface: rgba(255, 255, 255, 0.72);
			--surface-strong: rgba(255, 255, 255, 0.92);
			--shadow-soft: 0 20px 45px rgba(20, 77, 172, 0.14);
			--shadow-hover: 0 30px 55px rgba(20, 77, 172, 0.2);
			--radius-xl: 20px;
			--radius-lg: 16px;
			--radius-pill: 999px;
			--success: #21b45a;
			--warning: #f5b301;
			--info: #1f7aec;
			--danger: #ef4444;
			--transition: all 0.28s ease;
		}

		html,
		body {
			font-family: 'Poppins', sans-serif;
			background: linear-gradient(135deg, #f7fbff 0%, #eef8ff 40%, #eaf6ff 100%);
			color: var(--text-dark);
			min-height: 100%;
			scroll-behavior: smooth;
		}

		body {
			position: relative;
			overflow-x: hidden;
		}

		/* =======================
		   DECORATIVE BACKGROUND BLOBS
		======================== */
		.bg-blob {
			position: fixed;
			border-radius: 50%;
			filter: blur(14px);
			z-index: -1;
			opacity: 0.6;
			pointer-events: none;
		}

		.bg-blob.one {
			width: 340px;
			height: 340px;
			top: -80px;
			right: -90px;
			background: linear-gradient(135deg, rgba(79, 172, 254, 0.55), rgba(0, 198, 255, 0.38));
		}

		.bg-blob.two {
			width: 280px;
			height: 280px;
			bottom: 40px;
			left: -90px;
			background: linear-gradient(135deg, rgba(0, 198, 255, 0.35), rgba(79, 172, 254, 0.52));
		}

		/* =======================
		   PAGE WRAPPER
		======================== */
		.page-wrapper {
			width: min(1180px, 92%);
			margin: 0 auto;
			padding: 86px 0 100px;
		}

		/* =======================
		   MINI NAVBAR
		======================== */
		.mini-navbar {
			display: flex;
			justify-content: flex-start;
			margin-bottom: 34px;
			animation: fadeInUp 0.75s ease both;
		}

		.mini-nav-link {
			display: inline-flex;
			align-items: center;
			gap: 10px;
			text-decoration: none;
			font-size: 0.94rem;
			font-weight: 500;
			color: #0f4ea5;
			background: rgba(255, 255, 255, 0.72);
			border: 1px solid rgba(79, 172, 254, 0.35);
			backdrop-filter: blur(10px);
			border-radius: var(--radius-pill);
			padding: 10px 18px;
			box-shadow: 0 10px 24px rgba(21, 101, 192, 0.15);
			transition: var(--transition);
		}

		.mini-nav-link:hover {
			transform: translateY(-2px);
			box-shadow: 0 16px 26px rgba(21, 101, 192, 0.2);
			color: #093d82;
		}

		/* =======================
		   HEADER SECTION
		======================== */
		.hero-header {
			margin-bottom: 38px;
			animation: fadeInUp 0.95s ease both;
		}

		.hero-title {
			font-size: clamp(1.9rem, 3.8vw, 3.05rem);
			line-height: 1.18;
			font-weight: 800;
			letter-spacing: 0.2px;
			margin-bottom: 12px;
		}

		.gradient-text {
			background: linear-gradient(100deg, var(--blue-start), var(--blue-end));
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
			color: transparent;
		}

		.hero-subtitle {
			max-width: 760px;
			font-size: 1rem;
			font-weight: 400;
			color: var(--text-muted);
			line-height: 1.75;
		}

		/* =======================
		   ACTION BAR
		======================== */
		.action-bar {
			display: flex;
			justify-content: flex-end;
			align-items: center;
			margin-bottom: 22px;
			animation: fadeInUp 1.05s ease both;
		}

		.btn-add {
			display: inline-flex;
			align-items: center;
			gap: 10px;
			text-decoration: none;
			border: none;
			border-radius: 14px;
			padding: 12px 20px;
			font-size: 0.95rem;
			font-weight: 600;
			color: var(--white);
			background: linear-gradient(120deg, var(--blue-start), var(--blue-end));
			box-shadow: 0 14px 30px rgba(3, 138, 229, 0.35);
			transition: var(--transition);
		}

		.btn-add:hover {
			transform: translateY(-2px) scale(1.02);
			box-shadow: 0 0 0 5px rgba(79, 172, 254, 0.14), 0 20px 36px rgba(3, 138, 229, 0.38);
		}

		.btn-add:active {
			transform: translateY(0);
		}

		/* =======================
		   TABLE CARD CONTAINER
		======================== */
		.table-card {
			position: relative;
			background: var(--surface);
			border-radius: var(--radius-xl);
			border: 1px solid rgba(255, 255, 255, 0.65);
			backdrop-filter: blur(18px);
			padding: 28px;
			box-shadow: var(--shadow-soft);
			overflow: hidden;
			transition: var(--transition);
			animation: fadeInUp 1.12s ease both;
		}

		.table-card::before {
			content: '';
			position: absolute;
			inset: 0;
			border-radius: inherit;
			padding: 1px;
			background: linear-gradient(120deg, rgba(79, 172, 254, 0.52), rgba(0, 198, 255, 0.3));
			-webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
			-webkit-mask-composite: xor;
			mask-composite: exclude;
			pointer-events: none;
		}

		.table-card:hover {
			transform: translateY(-5px);
			box-shadow: var(--shadow-hover);
		}

		/* =======================
		   TABLE WRAPPER
		======================== */
		.table-wrap {
			width: 100%;
			overflow-x: auto;
			border-radius: var(--radius-lg);
		}

		.report-table {
			width: 100%;
			min-width: 840px;
			border-collapse: collapse;
			background: var(--surface-strong);
			border-radius: var(--radius-lg);
			overflow: hidden;
		}

		.report-table thead th {
			text-align: left;
			font-size: 0.86rem;
			text-transform: uppercase;
			letter-spacing: 0.55px;
			color: #4f627b;
			padding: 16px 18px;
			background: rgba(79, 172, 254, 0.13);
			border-bottom: 1px solid rgba(79, 172, 254, 0.24);
			font-weight: 700;
			white-space: nowrap;
		}

		.report-table tbody td {
			padding: 15px 18px;
			font-size: 0.95rem;
			color: #243852;
			border-bottom: 1px solid rgba(79, 172, 254, 0.14);
			vertical-align: middle;
		}

		.report-table tbody tr:last-child td {
			border-bottom: none;
		}

		.report-table tbody tr {
			transition: var(--transition);
		}

		.report-table tbody tr:hover {
			background: rgba(79, 172, 254, 0.1);
		}

		.title-cell {
			font-weight: 600;
			color: #0d2b4e;
		}

		/* =======================
		   STATUS BADGE
		======================== */
		.status-badge {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 6px;
			border-radius: var(--radius-pill);
			padding: 7px 12px;
			font-size: 0.78rem;
			font-weight: 600;
			letter-spacing: 0.2px;
			color: #fff;
			white-space: nowrap;
		}

		.status-processing {
			background: var(--warning);
			box-shadow: 0 8px 14px rgba(245, 179, 1, 0.3);
		}

		.status-verified {
			background: var(--info);
			box-shadow: 0 8px 14px rgba(31, 122, 236, 0.28);
		}

		.status-finished {
			background: var(--success);
			box-shadow: 0 8px 14px rgba(33, 180, 90, 0.28);
		}

		/* =======================
		   ACTION BUTTONS
		======================== */
		.action-buttons {
			display: inline-flex;
			align-items: center;
			gap: 8px;
		}

		.btn-icon {
			width: 34px;
			height: 34px;
			border: none;
			border-radius: 11px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			color: #fff;
			text-decoration: none;
			transition: var(--transition);
		}

		.btn-edit {
			background: linear-gradient(120deg, #4facfe, #2f8ffc);
			box-shadow: 0 10px 18px rgba(47, 143, 252, 0.32);
		}

		.btn-delete {
			background: linear-gradient(120deg, #ff6b6b, #ef4444);
			box-shadow: 0 10px 18px rgba(239, 68, 68, 0.34);
		}

		.btn-icon:hover {
			transform: scale(1.08);
			filter: brightness(1.06);
		}

		.delete-form {
			display: inline-block;
			margin: 0;
		}

		/* =======================
		   EMPTY STATE
		======================== */
		.empty-state {
			text-align: center;
			min-height: 300px;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			gap: 14px;
			color: #6b7a90;
			padding: 46px 18px;
		}

		.empty-state i {
			font-size: clamp(2.5rem, 7vw, 4rem);
			background: linear-gradient(130deg, var(--blue-start), var(--blue-end));
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			background-clip: text;
			color: transparent;
		}

		.empty-state h3 {
			font-size: 1.3rem;
			font-weight: 700;
			color: #284b72;
		}

		.empty-state p {
			font-size: 0.95rem;
			max-width: 460px;
			line-height: 1.7;
		}

		/* =======================
		   RESPONSIVE BREAKPOINTS
		======================== */
		@media (max-width: 992px) {
			.page-wrapper {
				width: min(1220px, 94%);
				padding-top: 80px;
			}

			.table-card {
				padding: 22px;
			}

			.hero-subtitle {
				max-width: 100%;
			}
		}

		@media (max-width: 768px) {
			.page-wrapper {
				padding: 82px 0 90px;
			}

			.mini-navbar {
				margin-bottom: 26px;
			}

			.hero-header {
				margin-bottom: 28px;
			}

			.action-bar {
				justify-content: flex-start;
				margin-bottom: 20px;
			}

			.btn-add {
				width: 100%;
				justify-content: center;
			}

			.table-card {
				padding: 18px;
				border-radius: 18px;
			}

			.report-table thead th,
			.report-table tbody td {
				padding: 14px 14px;
			}
		}

		@media (max-width: 520px) {
			.mini-nav-link {
				font-size: 0.86rem;
				padding: 9px 14px;
			}

			.hero-subtitle {
				font-size: 0.93rem;
				line-height: 1.65;
			}

			.table-wrap {
				border-radius: 14px;
			}

			.status-badge {
				padding: 6px 10px;
				font-size: 0.74rem;
			}
		}

		/* =======================
		   FADE-IN ANIMATION
		======================== */
		@keyframes fadeInUp {
			from {
				opacity: 0;
				transform: translateY(20px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
	</style>
</head>
<body>
	<!-- =======================
		 Background Decoration
	======================== -->
	<div class="bg-blob one"></div>
	<div class="bg-blob two"></div>

	<!-- =======================
		 Main Wrapper
	======================== -->
	<main class="page-wrapper">

		<!-- =======================
			 Mini Navbar
		======================== -->
		<nav class="mini-navbar" aria-label="Navigasi mini admin">
			<a href="{{ url('/') }}" class="mini-nav-link">
				<i class="fa-solid fa-arrow-left"></i>
				<span>Kembali ke Landing Page</span>
			</a>
		</nav>

		<!-- =======================
			 Header Section
		======================== -->
		<header class="hero-header">
			<h1 class="hero-title gradient-text">Manajemen Laporan Bencana</h1>
			<p class="hero-subtitle">
				Kelola seluruh laporan kejadian bencana secara terstruktur, cepat, dan profesional.
				Pantau status verifikasi laporan serta lakukan tindakan administratif dari satu dashboard.
			</p>
		</header>

		<!-- =======================
			 Button Tambah Laporan
		======================== -->
		<div class="action-bar">
			<a href="{{ route('reports.create') }}" class="btn-add">
				<i class="fa-solid fa-plus"></i>
				<span>Tambah Laporan</span>
			</a>
		</div>

		<!-- =======================
			 Card Container Tabel
		======================== -->
		<section class="table-card" aria-label="Daftar laporan bencana">
			@if (session('success'))
				<div style="margin-bottom:16px; padding:12px 14px; border-radius:12px; background:rgba(33,180,90,0.13); color:#157a3f; font-size:0.9rem; font-weight:500;">
					{{ session('success') }}
				</div>
			@endif

			@forelse ($reports as $report)
				@if ($loop->first)
					<!-- =======================
						 Modern Table
					======================== -->
					<div class="table-wrap">
						<table class="report-table">
							<thead>
								<tr>
									<th>Judul</th>
									<th>Jenis Bencana</th>
									<th>Lokasi</th>
									<th>Tanggal</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
				@endif

				<tr>
					<td class="title-cell">{{ $report->title }}</td>
					<td>{{ $report->disaster_type }}</td>
					<td>{{ $report->location }}</td>
					<td>{{ \Carbon\Carbon::parse($report->report_date)->translatedFormat('d M Y') }}</td>
					<td>
						@php
							$statusClass = match ($report->status) {
								'Diverifikasi' => 'status-verified',
								'Selesai' => 'status-finished',
								default => 'status-processing',
							};
						@endphp
						<span class="status-badge {{ $statusClass }}">{{ $report->status }}</span>
					</td>
					<td>
						<div class="action-buttons">
							<a href="{{ route('reports.edit', $report->id) }}" class="btn-icon btn-edit" title="Edit laporan">
								<i class="fa-solid fa-pen"></i>
							</a>
							<form class="delete-form" action="{{ route('reports.destroy', $report->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn-icon btn-delete" title="Hapus laporan">
									<i class="fa-solid fa-trash"></i>
								</button>
							</form>
						</div>
					</td>
				</tr>

				@if ($loop->last)
							</tbody>
						</table>
					</div>
				@endif
			@empty
				<!-- =======================
					 Empty State
				======================== -->
				<div class="empty-state">
					<i class="fa-regular fa-folder-open"></i>
					<h3>Belum ada laporan</h3>
					<p>
						Data laporan bencana belum tersedia. Silakan tambahkan laporan pertama Anda
						melalui tombol <strong>Tambah Laporan</strong> di atas.
					</p>
				</div>
			@endforelse
		</section>
	</main>
</body>
</html>
