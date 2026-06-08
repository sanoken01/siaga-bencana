<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membaca Status Peringatan Dini | Siaga Bencana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; line-height: 1.7; }
        .gradient-text { background: linear-gradient(135deg, #0e7490 0%, #0369a1 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .content-area p { margin-bottom: 1.5rem; color: #334155; font-size: 1.1rem; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route('welcome') }}" class="text-xl font-extrabold gradient-text tracking-tight">SIAGA BENCANA</a>
            <a href="{{ route('welcome') }}#edukasi" class="text-sm font-bold text-slate-600 hover:text-cyan-600 transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </nav>

    <article class="max-w-4xl mx-auto px-4 py-12">
        <header class="mb-10 text-center">
            <div class="inline-block px-4 py-1.5 bg-cyan-50 text-cyan-600 text-xs font-bold rounded-full uppercase tracking-widest mb-4">
                Berita Utama
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-6">Membaca Status Peringatan Dini</h1>
            <div class="flex items-center justify-center gap-6 text-sm text-slate-500 font-medium">
                <div class="flex items-center">
                    <i class="fa-solid fa-calendar-day mr-2 text-cyan-500"></i>
                    08 Jun 2026
                </div>
                <div class="flex items-center">
                    <i class="fa-solid fa-user-pen mr-2 text-cyan-500"></i>
                    Tim Edukasi
                </div>
            </div>
        </header>

        <div class="mb-12 rounded-3xl overflow-hidden shadow-2xl shadow-cyan-100">
            <img src="https://images.unsplash.com/photo-1454165833767-027ff33027b6?q=80&w=2070&auto=format&fit=crop" alt="Peringatan Dini" class="w-full h-auto object-cover max-h-[500px]">
        </div>

        <div class="content-area bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-slate-100">
            <p>Memahami status peringatan dini sangat penting untuk menentukan langkah keselamatan selanjutnya. Indonesia menggunakan sistem peringatan dini berbasis warna dan tingkatan aktivitas.</p>
            
            <div class="space-y-6 mb-8">
                <div class="flex gap-4 p-4 rounded-2xl bg-green-50 border border-green-100">
                    <div class="w-4 h-full bg-green-500 rounded-full"></div>
                    <div>
                        <h4 class="font-bold text-green-900">NORMAL (Hijau)</h4>
                        <p class="text-sm text-green-700 mb-0">Tidak ada ancaman bencana yang terdeteksi. Masyarakat dapat beraktivitas seperti biasa namun tetap waspada.</p>
                    </div>
                </div>
                
                <div class="flex gap-4 p-4 rounded-2xl bg-yellow-50 border border-yellow-100">
                    <div class="w-4 h-full bg-yellow-500 rounded-full"></div>
                    <div>
                        <h4 class="font-bold text-yellow-900">WASPADA (Kuning)</h4>
                        <p class="text-sm text-yellow-700 mb-0">Muncul peningkatan aktivitas atau ancaman bencana. Masyarakat mulai bersiap-siap dan mengikuti informasi resmi.</p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 rounded-2xl bg-orange-50 border border-orange-100">
                    <div class="w-4 h-full bg-orange-500 rounded-full"></div>
                    <div>
                        <h4 class="font-bold text-orange-900">SIAGA (Oranye)</h4>
                        <p class="text-sm text-orange-700 mb-0">Ancaman bencana sudah nyata. Kelompok rentan (anak-anak, lansia, ibu hamil) disarankan untuk segera evakuasi ke tempat aman.</p>
                    </div>
                </div>

                <div class="flex gap-4 p-4 rounded-2xl bg-red-50 border border-red-100">
                    <div class="w-4 h-full bg-red-500 rounded-full"></div>
                    <div>
                        <h4 class="font-bold text-red-900">AWAS (Merah)</h4>
                        <p class="text-sm text-red-700 mb-0">Bencana segera terjadi atau sedang terjadi. Seluruh warga wajib melakukan evakuasi mandiri ke titik kumpul yang telah ditentukan.</p>
                    </div>
                </div>
            </div>

            <p>Pastikan Anda selalu memantau sumber informasi resmi dari BMKG, BNPB, atau BPBD setempat untuk mendapatkan update status terbaru.</p>
        </div>
    </article>

    <footer class="bg-slate-900 text-slate-400 py-12 mt-20">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <p class="text-sm">© 2026 SIAGA BENCANA. Platform Edukasi & Monitoring Bencana Indonesia.</p>
        </div>
    </footer>
</body>
</html>
