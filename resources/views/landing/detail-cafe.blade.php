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
        $suasanaLabel = match ((int) $cafe->suasana) {
            3 => 'Nyaman',
            2 => 'Sedang',
            1 => 'Tidak Nyaman',
            default => '-',
        };

        $jarakCafe = abs((float) $cafe->jarak);

        $fotoCafe = $cafe->foto ? json_decode($cafe->foto, true) : [];

        if (!is_array($fotoCafe)) {
            $fotoCafe = [];
        }

        $defaultFoto = 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=1200&q=80';

        if (count($fotoCafe) === 0) {
            $fotoCafe = [$defaultFoto];
            $pakaiFotoDefault = true;
        } else {
            $pakaiFotoDefault = false;
        }
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
        <div class="grid lg:grid-cols-2 gap-10 items-stretch">

            {{-- INFO KIRI --}}
            <div class="flex flex-col">

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
                <div class="mt-5 bg-zinc-900 border border-white/10 rounded-2xl p-6 flex-1">
                    <p class="text-sm text-gray-400 mb-3">
                        Suasana Cafe
                    </p>

                    <h3 class="text-2xl font-black text-white">
                        {{ $suasanaLabel }}
                    </h3>
                </div>

            </div>

            {{-- GAMBAR KANAN --}}
            <div class="relative rounded-3xl overflow-hidden border border-white/10 bg-zinc-900 shadow-2xl group h-full min-h-[520px]">

                <div id="sliderCafe" class="relative w-full h-full overflow-hidden">

                    @foreach ($fotoCafe as $index => $foto)
                        @php
                            $srcFoto = $pakaiFotoDefault ? $foto : asset('storage/' . $foto);
                        @endphp

                        <img
                            src="{{ $srcFoto }}"
                            alt="{{ $cafe->nama_cafe }}"
                            onclick="bukaZoomFoto({{ $index }})"
                            class="slide-foto absolute inset-0 w-full h-full object-cover cursor-zoom-in transition-all duration-700 ease-in-out
                                {{ $index === 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-105' }}">
                    @endforeach

                </div>

                {{-- GRADIENT --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent pointer-events-none"></div>

                {{-- TOMBOL ZOOM --}}
                <button
                    type="button"
                    onclick="zoomFotoAktif()"
                    class="absolute top-5 left-5 bg-black/60 hover:bg-black/80 text-white text-sm px-4 py-2 rounded-full opacity-0 group-hover:opacity-100 transition">
                    🔍 Lihat Foto
                </button>

                @if (count($fotoCafe) > 1)

                    {{-- TOMBOL KIRI --}}
                    <button
                        type="button"
                        onclick="prevFoto()"
                        class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/60 hover:bg-black/80 text-white w-12 h-12 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition text-2xl">
                        &#10094;
                    </button>

                    {{-- TOMBOL KANAN --}}
                    <button
                        type="button"
                        onclick="nextFoto()"
                        class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/60 hover:bg-black/80 text-white w-12 h-12 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition text-2xl">
                        &#10095;
                    </button>

                    {{-- DOT INDICATOR --}}
                    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2">
                        @foreach ($fotoCafe as $index => $foto)
                            <button
                                type="button"
                                onclick="goToFoto({{ $index }})"
                                class="dot-foto h-2.5 rounded-full transition-all duration-300
                                    {{ $index === 0 ? 'w-8 bg-white' : 'w-2.5 bg-white/50' }}">
                            </button>
                        @endforeach
                    </div>

                    {{-- NOMOR FOTO --}}
                    <div class="absolute top-5 right-5 bg-black/60 text-white text-sm px-3 py-1 rounded-full">
                        <span id="nomorFoto">1</span> / {{ count($fotoCafe) }}
                    </div>

                @endif

            </div>

        </div>

        {{-- MODAL ZOOM FOTO --}}
        <div
            id="modalZoomFoto"
            class="fixed inset-0 bg-black/95 z-[9999] hidden items-center justify-center p-6">

            {{-- CLOSE --}}
            <button
                type="button"
                onclick="tutupZoomFoto()"
                class="absolute top-6 right-6 bg-white text-black w-11 h-11 rounded-full font-black text-xl hover:bg-gray-200 transition z-20">
                ×
            </button>

            {{-- NOMOR ZOOM --}}
            <div class="absolute top-6 left-6 bg-white/10 border border-white/20 text-white px-4 py-2 rounded-full text-sm z-20">
                <span id="nomorZoomFoto">1</span> / {{ count($fotoCafe) }}
            </div>

            {{-- TOMBOL ZOOM KIRI --}}
            @if (count($fotoCafe) > 1)
                <button
                    type="button"
                    onclick="prevZoomFoto()"
                    class="absolute left-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 border border-white/20 text-white w-14 h-14 rounded-full flex items-center justify-center text-3xl transition z-20">
                    &#10094;
                </button>

                {{-- TOMBOL ZOOM KANAN --}}
                <button
                    type="button"
                    onclick="nextZoomFoto()"
                    class="absolute right-6 top-1/2 -translate-y-1/2 bg-white/10 hover:bg-white/20 border border-white/20 text-white w-14 h-14 rounded-full flex items-center justify-center text-3xl transition z-20">
                    &#10095;
                </button>
            @endif

            {{-- GAMBAR ZOOM --}}
            <img
                id="gambarZoomFoto"
                src=""
                alt="Foto Cafe"
                class="max-w-full max-h-[88vh] object-contain rounded-2xl shadow-2xl border border-white/10 transition-all duration-500 scale-95 opacity-0">

            {{-- DOT ZOOM --}}
            @if (count($fotoCafe) > 1)
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-20">
                    @foreach ($fotoCafe as $index => $foto)
                        <button
                            type="button"
                            onclick="goToZoomFoto({{ $index }})"
                            class="dot-zoom-foto h-2.5 rounded-full transition-all duration-300
                                {{ $index === 0 ? 'w-8 bg-white' : 'w-2.5 bg-white/50' }}">
                        </button>
                    @endforeach
                </div>
            @endif

        </div>

        {{-- MAP --}}
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

    {{-- SCRIPT SLIDER DAN ZOOM FOTO --}}
    <script>
        let indexFotoAktif = 0;
        let indexZoomAktif = 0;

        const slidesFoto = document.querySelectorAll('.slide-foto');
        const dotsFoto = document.querySelectorAll('.dot-foto');
        const nomorFoto = document.getElementById('nomorFoto');

        const modalZoomFoto = document.getElementById('modalZoomFoto');
        const gambarZoomFoto = document.getElementById('gambarZoomFoto');
        const nomorZoomFoto = document.getElementById('nomorZoomFoto');
        const dotsZoomFoto = document.querySelectorAll('.dot-zoom-foto');

        const daftarFoto = [
            @foreach ($fotoCafe as $foto)
                @if ($pakaiFotoDefault)
                    "{{ $foto }}",
                @else
                    "{{ asset('storage/' . $foto) }}",
                @endif
            @endforeach
        ];

        function tampilkanFoto(index) {
            slidesFoto.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0', 'scale-105');
                    slide.classList.add('opacity-100', 'scale-100');
                } else {
                    slide.classList.remove('opacity-100', 'scale-100');
                    slide.classList.add('opacity-0', 'scale-105');
                }
            });

            dotsFoto.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('w-2.5', 'bg-white/50');
                    dot.classList.add('w-8', 'bg-white');
                } else {
                    dot.classList.remove('w-8', 'bg-white');
                    dot.classList.add('w-2.5', 'bg-white/50');
                }
            });

            if (nomorFoto) {
                nomorFoto.innerText = index + 1;
            }
        }

        function nextFoto() {
            if (slidesFoto.length <= 1) return;

            indexFotoAktif++;

            if (indexFotoAktif >= slidesFoto.length) {
                indexFotoAktif = 0;
            }

            tampilkanFoto(indexFotoAktif);
        }

        function prevFoto() {
            if (slidesFoto.length <= 1) return;

            indexFotoAktif--;

            if (indexFotoAktif < 0) {
                indexFotoAktif = slidesFoto.length - 1;
            }

            tampilkanFoto(indexFotoAktif);
        }

        function goToFoto(index) {
            indexFotoAktif = index;
            tampilkanFoto(indexFotoAktif);
        }

        function bukaZoomFoto(index) {
            indexZoomAktif = index;

            modalZoomFoto.classList.remove('hidden');
            modalZoomFoto.classList.add('flex');

            document.body.style.overflow = 'hidden';

            tampilkanZoomFoto(indexZoomAktif);
        }

        function tampilkanZoomFoto(index) {
            if (!daftarFoto[index]) return;

            gambarZoomFoto.classList.remove('scale-100', 'opacity-100');
            gambarZoomFoto.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                gambarZoomFoto.src = daftarFoto[index];

                gambarZoomFoto.onload = function () {
                    gambarZoomFoto.classList.remove('scale-95', 'opacity-0');
                    gambarZoomFoto.classList.add('scale-100', 'opacity-100');
                };
            }, 120);

            if (nomorZoomFoto) {
                nomorZoomFoto.innerText = index + 1;
            }

            dotsZoomFoto.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.remove('w-2.5', 'bg-white/50');
                    dot.classList.add('w-8', 'bg-white');
                } else {
                    dot.classList.remove('w-8', 'bg-white');
                    dot.classList.add('w-2.5', 'bg-white/50');
                }
            });

            indexFotoAktif = index;
            tampilkanFoto(indexFotoAktif);
        }

        function nextZoomFoto() {
            if (daftarFoto.length <= 1) return;

            indexZoomAktif++;

            if (indexZoomAktif >= daftarFoto.length) {
                indexZoomAktif = 0;
            }

            tampilkanZoomFoto(indexZoomAktif);
        }

        function prevZoomFoto() {
            if (daftarFoto.length <= 1) return;

            indexZoomAktif--;

            if (indexZoomAktif < 0) {
                indexZoomAktif = daftarFoto.length - 1;
            }

            tampilkanZoomFoto(indexZoomAktif);
        }

        function goToZoomFoto(index) {
            indexZoomAktif = index;
            tampilkanZoomFoto(indexZoomAktif);
        }

        function tutupZoomFoto() {
            gambarZoomFoto.src = '';

            modalZoomFoto.classList.add('hidden');
            modalZoomFoto.classList.remove('flex');

            document.body.style.overflow = 'auto';
        }

        function zoomFotoAktif() {
            bukaZoomFoto(indexFotoAktif);
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                tutupZoomFoto();
            }

            if (!modalZoomFoto.classList.contains('hidden')) {
                if (e.key === 'ArrowRight') {
                    nextZoomFoto();
                }

                if (e.key === 'ArrowLeft') {
                    prevZoomFoto();
                }
            }
        });

        modalZoomFoto.addEventListener('click', function(e) {
            if (e.target.id === 'modalZoomFoto') {
                tutupZoomFoto();
            }
        });

        setInterval(() => {
            if (modalZoomFoto.classList.contains('hidden')) {
                nextFoto();
            }
        }, 4000);
    </script>

    {{-- SCRIPT MAP --}}
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