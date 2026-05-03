<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $cafe->nama_cafe }}</title>
    <link rel="stylesheet" href="{{ asset('css/data-cafe.css') }}">
</head>
<body>

<main class="page">
    <a href="{{ route('data.cafe') }}">← Kembali</a>

    <section class="why-section" style="margin-top:30px;">
        <img src="{{ $cafe->foto ? asset('storage/'.$cafe->foto) : 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=900&q=80' }}">

        <div>
            <span>DETAIL CAFE</span>
            <h2>{{ $cafe->nama_cafe }}</h2>
            <p>{{ $cafe->alamat }}</p>

            <ul>
                <li>Harga rata-rata: Rp {{ number_format($cafe->harga_menu, 0, ',', '.') }}</li>
                <li>Luas parkiran: {{ $cafe->luas_parkiran }} m²</li>
                <li>Kecepatan wifi: {{ $cafe->kecepatan_wifi }} Kbps</li>
                <li>Jarak: {{ $cafe->jarak }} km</li>
                <li>Suasana: {{ $cafe->suasana }}/5</li>
            </ul>

            <h3 style="margin-top:20px;">Menu</h3>
            <ul>
                @foreach ($cafe->menu as $menu)
                    <li>{{ $menu->nama_menu }} - Rp {{ number_format($menu->harga, 0, ',', '.') }}</li>
                @endforeach
            </ul>
        </div>
    </section>
</main>

</body>
</html>