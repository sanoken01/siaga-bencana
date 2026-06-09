@extends('edukasi.layout')

@section('title', 'Checklist Tas Siaga 72 Jam | Siaga Bencana')
@section('badge', 'Mitigasi')
@section('heroTitle', 'Checklist Tas Siaga 72 Jam')
@section('heroSubtitle', 'Tas siaga adalah paket hidup darurat yang harus selalu siap. Isi yang tepat membuat keluarga lebih tenang saat harus evakuasi cepat.')
@section('heroImage', 'https://cdn-1.timesmedia.co.id/images/2022/12/03/tas-siaga-bencana.jpg')
@section('heroNoteTitle', 'Target utama')
@section('heroNoteText', 'Siapkan semua kebutuhan dasar untuk bertahan setidaknya 72 jam pertama setelah bencana terjadi.')

@section('content')
    <div class="content-stack">
        <div class="content-card">
            <p>Tas siaga bencana adalah tas berisi kebutuhan dasar rumah tangga yang dipersiapkan sebelum bencana terjadi. Tas ini dirancang untuk membantu keluarga bertahan setidaknya selama 72 jam pertama setelah kejadian.</p>
        </div>

        <div class="highlight-grid">
            <div class="highlight-card">
                <div class="highlight-icon"><i class="fa-solid fa-file-shield"></i></div>
                <div>
                    <h3>Dokumen penting</h3>
                    <p>Fotokopi KK, KTP, ijazah, dan dokumen rumah dalam plastik kedap air.</p>
                </div>
            </div>

            <div class="highlight-card">
                <div class="highlight-icon"><i class="fa-solid fa-bottle-water"></i></div>
                <div>
                    <h3>Air minum</h3>
                    <p>Minimal 3 liter per orang per hari agar kebutuhan dasar tetap aman.</p>
                </div>
            </div>

            <div class="highlight-card">
                <div class="highlight-icon"><i class="fa-solid fa-kit-medical"></i></div>
                <div>
                    <h3>P3K & obat</h3>
                    <p>Siapkan obat pribadi, plester, antiseptik, dan alat kesehatan dasar.</p>
                </div>
            </div>

            <div class="highlight-card">
                <div class="highlight-icon"><i class="fa-solid fa-bolt"></i></div>
                <div>
                    <h3>Sumber cahaya</h3>
                    <p>Senter, baterai cadangan, dan radio portable untuk pantau informasi resmi.</p>
                </div>
            </div>

            <div class="highlight-card">
                <div class="highlight-icon"><i class="fa-solid fa-bowl-food"></i></div>
                <div>
                    <h3>Logistik cepat</h3>
                    <p>Makanan tahan lama, uang tunai secukupnya, dan perlengkapan mandi dasar.</p>
                </div>
            </div>

            <div class="highlight-card">
                <div class="highlight-icon"><i class="fa-solid fa-whistle"></i></div>
                <div>
                    <h3>Akses bantuan</h3>
                    <p>Peluit, masker, dan hand sanitizer untuk kebutuhan evakuasi harian.</p>
                </div>
            </div>
        </div>

        <div class="content-card">
            <h2 class="content-inline-title">Isi utama tas siaga</h2>
            <ul>
                <li>Dokumen penting disimpan dalam wadah kedap air.</li>
                <li>Air minum dan makanan instan yang tahan lama.</li>
                <li>Kotak P3K dan obat-obatan rutin.</li>
                <li>Lampu senter, baterai cadangan, dan radio portable.</li>
                <li>Uang tunai secukupnya, pakaian ganti, serta perlengkapan mandi.</li>
                <li>Masker, hand sanitizer, dan peluit bantuan.</li>
            </ul>
        </div>

        <div class="info-band">
            <strong>Tempat terbaik menyimpan tas:</strong> letakkan di area yang mudah dijangkau seperti dekat pintu keluar atau bawah tempat tidur supaya bisa diambil dalam hitungan detik.
        </div>
    </div>
@endsection
