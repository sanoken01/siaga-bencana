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
        button { border: none; background: #0b76d9; color: #fff; padding: 11px 14px; border-radius: 8px; cursor: pointer; font-weight: 700; width: 100%; }
        button:hover { background: #0a64b8; }
        .nav { margin-bottom: 14px; display: inline-block; text-decoration: none; color: #0f4b90; }
        .error { color: #dc2626; margin-bottom: 8px; font-size: 0.9rem; }
        .goal-card { background: #f0f9ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 14px; margin-bottom: 18px; }
        .goal-header { display: flex; justify-content: space-between; margin-bottom: 8px; font-weight: 600; }
        .progress-bar-bg { background: #e5e7eb; border-radius: 999px; height: 8px; overflow: hidden; margin-bottom: 8px; }
        .progress-bar-fill { background: linear-gradient(90deg, #10b981, #059669); height: 100%; border-radius: 999px; }
        .goal-text { font-size: 0.9rem; color: #3d4f70; }
    </style>
</head>
<body>
    <div class="card">
        <a class="nav" href="{{ route('reports.index') }}">← Kembali ke daftar laporan</a>
        <h1>Donasi untuk: {{ $report->title }}</h1>
        <p>Ini adalah laporan bencana yang sudah selesai. Donasi akan membantu pemulihan.</p>

        @php
            $collected = $report->getTotalDonations();
            $goal = $report->goal_amount ?? 1000000;
            $percentage = min(100, ($collected / $goal) * 100);
        @endphp

        <div class="goal-card">
            <div class="goal-header">
                <span>Target Terkumpul</span>
                <span style="color: #10b981;">{{ round($percentage, 1) }}%</span>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width: {{ $percentage }}%;"></div>
            </div>
            <div class="goal-text">
                <p><strong>Rp {{ number_format($collected, 0, ',', '.') }}</strong> dari Rp {{ number_format($goal, 0, ',', '.') }}</p>
                <p style="color: #6b7280; margin-top: 4px;">@if ($percentage >= 100) <span style="color: #10b981;">✓ Target tercapai!</span> @else Sisa: Rp {{ number_format($goal - $collected, 0, ',', '.') }} @endif</p>
            </div>
        </div>

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
