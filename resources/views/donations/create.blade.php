<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi untuk Bencana Selesai</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f7fbff; color: #1b2940; }
        .card { max-width: 580px; margin: 0 auto; background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 4px 18px rgba(0,0,0,0.08); }
        h1 { font-size: 1.5rem; margin-bottom: 6px; }
        p { color: #3d4f70; margin-bottom: 14px; }
        label { display: block; margin-bottom: 6px; font-weight: 600; }
        input, textarea, select { width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 10px; margin-bottom: 12px; font: inherit; }
        button { border: none; background: #0b76d9; color: #fff; padding: 11px 14px; border-radius: 8px; cursor: pointer; font-weight: 700; }
        button:hover { background: #0a64b8; }
        .nav { margin-bottom: 14px; display: inline-block; text-decoration: none; color: #0f4b90; }
        .error { color: #dc2626; margin-bottom: 8px; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="card">
        <a class="nav" href="{{ route('reports.index') }}">← Kembali ke daftar laporan</a>
        <h1>Donasi untuk: {{ $report->title }}</h1>
        <p>Ini adalah laporan bencana yang sudah selesai. Donasi akan membantu pemulihan.</p>

        <form method="POST" action="{{ route('reports.donate.store', $report->id) }}">
            @csrf
            <label for="donor_name">Nama Donatur</label>
            <input id="donor_name" name="donor_name" value="{{ old('donor_name') }}" required>
            @error('donor_name') <div class="error">{{ $message }}</div> @enderror

            <label for="amount">Jumlah (Rp)</label>
            <input id="amount" name="amount" type="number" min="1" value="{{ old('amount') }}" required>
            @error('amount') <div class="error">{{ $message }}</div> @enderror

            <label for="message">Pesan (opsional)</label>
            <textarea id="message" name="message" rows="4">{{ old('message') }}</textarea>
            @error('message') <div class="error">{{ $message }}</div> @enderror

            <button type="submit">Kirim Donasi</button>
        </form>
    </div>
</body>
</html>
