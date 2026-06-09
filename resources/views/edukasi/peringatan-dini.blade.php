@extends('edukasi.layout')

@section('title', 'Membaca Status Peringatan Dini | Siaga Bencana')
@section('badge', 'Edukasi')
@section('heroTitle', 'Membaca Status Peringatan Dini')
@section('heroSubtitle', 'Setiap warna punya makna tindakan. Semakin cepat Anda memahami level ancaman, semakin tepat langkah evakuasi yang bisa diambil.')
@section('heroImage', 'https://tse1.mm.bing.net/th/id/OIP.or5FE6l7RkC5PKsQCrNUXgHaFj?pid=Api&P=0&h=180')
@section('heroNoteTitle', 'Baca dengan cepat')
@section('heroNoteText', 'Warna hijau sampai merah bukan sekadar label. Itu sinyal untuk menentukan apakah cukup waspada atau harus segera evakuasi.')

@section('content')
    <div class="content-stack">
        <div class="content-card">
            <p>Memahami status peringatan dini sangat penting untuk menentukan langkah keselamatan selanjutnya. Indonesia menggunakan sistem berbasis warna dan tingkat aktivitas agar masyarakat mudah mengenali level ancaman.</p>
        </div>

        <div class="status-list">
            <div class="content-card flex gap-4 items-start">
                <span class="status-pill" style="background: rgba(34, 197, 94, 0.12); color: #166534;"><i class="fa-solid fa-circle"></i> Normal</span>
                <div>
                    <h3 class="content-inline-title" style="margin-bottom: 0.35rem;">NORMAL</h3>
                    <p class="mb-0">Tidak ada ancaman bencana yang terdeteksi. Aktivitas dapat berjalan seperti biasa, tetapi pantau sumber resmi secara berkala.</p>
                </div>
            </div>

            <div class="content-card flex gap-4 items-start">
                <span class="status-pill" style="background: rgba(234, 179, 8, 0.14); color: #92400e;"><i class="fa-solid fa-circle"></i> Waspada</span>
                <div>
                    <h3 class="content-inline-title" style="margin-bottom: 0.35rem;">WASPADA</h3>
                    <p class="mb-0">Ada peningkatan aktivitas atau ancaman. Mulai siapkan perlengkapan, perhatikan jalur evakuasi, dan ikuti informasi resmi.</p>
                </div>
            </div>

            <div class="content-card flex gap-4 items-start">
                <span class="status-pill" style="background: rgba(249, 115, 22, 0.14); color: #9a3412;"><i class="fa-solid fa-circle"></i> Siaga</span>
                <div>
                    <h3 class="content-inline-title" style="margin-bottom: 0.35rem;">SIAGA</h3>
                    <p class="mb-0">Ancaman sudah nyata. Kelompok rentan seperti anak-anak, lansia, dan ibu hamil perlu bersiap pindah ke tempat aman.</p>
                </div>
            </div>

            <div class="content-card flex gap-4 items-start">
                <span class="status-pill" style="background: rgba(239, 68, 68, 0.14); color: #991b1b;"><i class="fa-solid fa-circle"></i> Awas</span>
                <div>
                    <h3 class="content-inline-title" style="margin-bottom: 0.35rem;">AWAS</h3>
                    <p class="mb-0">Bencana segera terjadi atau sedang berlangsung. Lakukan evakuasi mandiri ke titik kumpul yang aman tanpa menunda.</p>
                </div>
            </div>
        </div>

        <div class="info-band">
            <strong>Selalu pantau sumber resmi</strong> dari BMKG, BNPB, atau BPBD setempat agar status terbaru dan instruksi evakuasi tidak terlewat.
        </div>
    </div>
@endsection
