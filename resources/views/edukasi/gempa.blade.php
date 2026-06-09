@extends('edukasi.layout')

@section('title', 'Panduan Evakuasi Gempa Aman | Siaga Bencana')
@section('badge', 'Edukasi')
@section('heroTitle', 'Panduan Evakuasi Gempa Aman')
@section('heroSubtitle', 'Langkah paling penting saat gempa bukan panik dan lari, tetapi mengunci posisi aman lalu bergerak dengan disiplin sampai guncangan berhenti.')
@section('heroImage', 'https://gdb.voanews.com/0a3ad510-91cf-4325-b98e-09419ca9192f_w1200_r1.jpg')
@section('heroNoteTitle', 'Aturan emas')
@section('heroNoteText', 'Ingat urutan Drop, Cover, and Hold On. Tindakan singkat yang benar jauh lebih efektif daripada reaksi tergesa-gesa.')

@section('content')
    <div class="content-stack">
        <div class="content-card">
            <p>Saat terjadi gempa bumi, kepanikan adalah musuh utama. Fokus pertama adalah tetap tenang, menjaga keseimbangan, dan menghindari gerakan acak yang justru menambah risiko cedera.</p>
            <p class="mb-0">Gunakan prinsip <strong>Drop, Cover, and Hold On</strong> sebagai respons standar di dalam ruangan.</p>
        </div>

        <div class="highlight-grid">
            <div class="highlight-card">
                <div class="highlight-icon"><i class="fa-solid fa-person-falling-burst"></i></div>
                <div>
                    <h3>DROP</h3>
                    <p>Turunkan badan ke tangan dan lutut agar tidak terjatuh ketika getaran mulai kuat.</p>
                </div>
            </div>

            <div class="highlight-card">
                <div class="highlight-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <div>
                    <h3>COVER</h3>
                    <p>Lindungi kepala dan leher di bawah meja kokoh, lalu jauhi kaca atau benda yang mudah runtuh.</p>
                </div>
            </div>

            <div class="highlight-card">
                <div class="highlight-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                <div>
                    <h3>HOLD ON</h3>
                    <p>Pegang meja atau struktur pelindung sampai guncangan selesai agar posisi aman tetap stabil.</p>
                </div>
            </div>
        </div>

        <div class="content-card">
            <h2 class="content-inline-title">Urutan respons cepat</h2>
            <ol>
                <li><strong>DROP:</strong> Jatuhkan tubuh ke posisi aman sebelum getaran menjatuhkan Anda.</li>
                <li><strong>COVER:</strong> Lindungi kepala, leher, dan tubuh dengan perlindungan terdekat yang kuat.</li>
                <li><strong>HOLD ON:</strong> Bertahan di posisi tersebut sampai kondisi benar-benar stabil.</li>
            </ol>
        </div>

        <div class="info-band">
            <strong>Jika berada di luar ruangan:</strong> menjauhlah dari bangunan, papan reklame, tiang listrik, dan pohon besar. Cari area terbuka dan tunggu hingga getaran selesai sebelum berpindah.
        </div>
    </div>
@endsection
