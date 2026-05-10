<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/detail-cafe.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cafe->nama_cafe }} - SPK Cafe</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white min-h-screen">

    @php
        $suasanaValue = $cafe->suasana;

      $suasanaLabel = match ((int) $cafe->suasana) {
        3 => 'Nyaman',
        2 => 'Sedang',
        1 => 'Tidak Nyaman',
        default => '-',
    };

        $jarakCafe = abs((float) $cafe->jarak);
    @endphp

    {{-- NAVBAR --}}
    <header class="border-b border-white/10 backdrop-blur bg-black/90 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-10">
            <div class="flex items-center justify-between h-20">

                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/logo-five.png') }}" class="w-11 h-11 object-contain" alt="Logo">

                    <div>
                        <h1 class="font-bold text-2xl text-white">
                            SPK Cafe
                        </h1>
                    </div>
                </a>

                <nav class="flex items-center gap-10 text-sm font-semibold">
                    <a href="{{ route('landing') }}" class="text-gray-300 hover:text-white transition">
                        Dashboard
                    </a>

                    <a href="{{ route('data.cafe') }}" class="text-white border-b-2 border-white pb-1">
                        Data Cafe
                    </a>
                </nav>

            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="max-w-7xl mx-auto px-6 lg:px-10 py-14">

        {{-- BACK --}}
        <a href="{{ route('data.cafe') }}"
            class="inline-flex items-center gap-3 bg-white text-black px-6 py-3 rounded-2xl font-bold hover:bg-gray-200 transition mb-10 shadow-lg">
            <span class="text-xl">←</span>
            Kembali ke Data Cafe
        </a>

        {{-- DETAIL --}}
        <div class="grid lg:grid-cols-2 gap-10 items-start">

            {{-- IMAGE --}}
            <div class="rounded-3xl overflow-hidden border border-white/10 bg-zinc-900 shadow-2xl">
                <img src="{{ $cafe->foto
                    ? asset('storage/' . $cafe->foto)
                    : 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=1200&q=80' }}"
                    class="w-full h-[500px] object-cover" alt="{{ $cafe->nama_cafe }}">
            </div>

            {{-- INFO --}}
            <div>

                <span class="uppercase tracking-[0.3em] text-sm text-slate-400 font-semibold">
                    Detail Cafe
                </span>

                <h1 class="text-5xl font-black mt-4 leading-tight">
                    {{ $cafe->nama_cafe }}
                </h1>

                <p class="text-gray-400 text-lg mt-4 leading-relaxed">
                    {{ $cafe->alamat }}
                </p>

                {{-- STATS --}}
                <div class="grid grid-cols-2 gap-5 mt-10">

                    <div class="bg-zinc-900 border border-white/10 rounded-2xl p-5">
                        <p class="text-sm text-gray-400 mb-2">
                            Harga Rata-rata
                        </p>

                        <h3 class="text-2xl font-bold text-white">
                            Rp {{ number_format($cafe->harga_menu, 0, ',', '.') }}
                        </h3>
                    </div>

                    <div class="bg-zinc-900 border border-white/10 rounded-2xl p-5">
                        <p class="text-sm text-gray-400 mb-2">
                            Parkiran
                        </p>

                        <h3 class="text-2xl font-bold text-white">
                            {{ $cafe->luas_parkiran }} m²
                        </h3>
                    </div>

                    <div class="bg-zinc-900 border border-white/10 rounded-2xl p-5">
                        <p class="text-sm text-gray-400 mb-2">
                            Kecepatan Wifi
                        </p>

                        <h3 class="text-2xl font-bold text-white">
                            {{ $cafe->kecepatan_wifi }} Kbps
                        </h3>
                    </div>

                    <div class="bg-zinc-900 border border-white/10 rounded-2xl p-5">
                        <p class="text-sm text-gray-400 mb-2">
                            Jarak
                        </p>

                        <h3 class="text-2xl font-bold text-white">
                            {{ $jarakCafe }} km
                        </h3>
                    </div>

                </div>

                {{-- SUASANA --}}
                <div class="mt-5 bg-zinc-900 border border-white/10 rounded-2xl p-6">
                    <p class="text-sm text-gray-400 mb-3">
                        Suasana Cafe
                    </p>

                    <h3 class="text-2xl font-black text-white">
                        {{ $suasanaLabel }}
                    </h3>
                </div>

            </div>

        </div>
            <section class="detail-map-section">
    <div class="section-label">LOKASI CAFE</div>
    <h2>Lokasi {{ $cafe->nama_cafe }}</h2>

    <div id="mapDetail"></div>

    <a href="https://www.google.com/maps?q={{ $cafe->latitude }},{{ $cafe->longitude }}"
       target="_blank"
       class="map-btn">
        Buka di Google Maps
    </a>
</section>
        {{-- MENU --}}
        <section class="mt-16">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <p class="uppercase tracking-[0.3em] text-sm text-slate-500 font-semibold">
                        Menu Cafe
                    </p>

                    <h2 class="text-4xl font-black mt-3">
                        Daftar Menu
                    </h2>
                </div>
            </div>

            <div class="bg-zinc-950 border border-white/10 rounded-3xl overflow-hidden">

                <table class="w-full">

                    <thead class="bg-white/5 border-b border-white/10">
                        <tr>
                            <th class="text-left px-8 py-5 text-gray-300">
                                No
                            </th>

                            <th class="text-left px-8 py-5 text-gray-300">
                                Nama Menu
                            </th>

                            <th class="text-left px-8 py-5 text-gray-300">
                                Harga
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($cafe->menu as $menu)
                            <tr class="border-b border-white/5 hover:bg-white/[0.03] transition">

                                <td class="px-8 py-6 font-bold text-gray-400">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-8 py-6 font-semibold text-lg">
                                    {{ $menu->nama_menu }}
                                </td>

                                <td class="px-8 py-6 text-green-400 font-bold">
                                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-10 text-gray-500">
                                    Belum ada menu tersedia.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </main>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const cafeLat = {{ $cafe->latitude ?? -7.9131382 }};
    const cafeLng = {{ $cafe->longitude ?? 113.8225832 }};

    const map = L.map('mapDetail').setView([cafeLat, cafeLng], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    L.marker([cafeLat, cafeLng])
        .addTo(map)
        .bindPopup("{{ $cafe->nama_cafe }}")
        .openPopup();
</script>
</body>

</html>
