<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Evakuasi Gempa Aman | Siaga Bencana</title>
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
                Edukasi
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight mb-6">Panduan Evakuasi Gempa Aman</h1>
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
            <img src="https://images.unsplash.com/photo-1511044491314-f1da25424509?q=80&w=2070&auto=format&fit=crop" alt="Panduan Evakuasi Gempa" class="w-full h-auto object-cover max-h-[500px]">
        </div>

        <div class="content-area bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-slate-100">
            <p>Saat terjadi gempa bumi, kepanikan adalah musuh utama. Langkah pertama yang harus dilakukan adalah tetap tenang dan tidak berlari keluar ruangan secara serampangan.</p>
            
            <p>Ikuti langkah **Drop, Cover, and Hold On**:</p>
            <ol class="list-decimal pl-6 mb-6 space-y-4 text-slate-700">
                <li><strong>DROP:</strong> Segera jatuhkan badan ke tangan dan lutut Anda sebelum gempa menjatuhkan Anda. Posisi ini melindungi Anda agar tidak terjatuh dan memungkinkan Anda untuk tetap bisa bergerak jika perlu.</li>
                <li><strong>COVER:</strong> Lindungi kepala dan leher Anda (serta seluruh tubuh jika mungkin) di bawah meja yang kokoh atau furnitur yang kuat lainnya. Jika tidak ada meja di dekat Anda, merapatlah ke dinding bagian dalam dan lindungi kepala Anda dengan lengan.</li>
                <li><strong>HOLD ON:</strong> Berpeganganlah pada meja tersebut sampai guncangan berhenti. Bersiaplah untuk bergerak bersama meja jika meja tersebut bergeser.</li>
            </ol>

            <p>Jika Anda berada di luar ruangan, menjauhlah dari bangunan, pohon, papan reklame, dan tiang listrik. Cari area terbuka yang aman dari risiko benda jatuh.</p>
        </div>
    </article>

    <footer class="bg-slate-900 text-slate-400 py-12 mt-20">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <p class="text-sm">© 2026 SIAGA BENCANA. Platform Edukasi & Monitoring Bencana Indonesia.</p>
        </div>
    </footer>
</body>
</html>
