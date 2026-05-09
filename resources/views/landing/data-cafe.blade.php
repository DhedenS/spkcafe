<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Cafe - SPK Cafe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/data-cafe.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar">
        <div class="nav-brand">
            <img src="{{ asset('assets/logo-five.png') }}" alt="Logo">
            <span>SPK Cafe</span>
        </div>

        <div class="nav-menu">
            <a href="/">Dashboard</a>
            <a href="{{ route('data.cafe') }}" class="active">Data Cafe</a>
        </div>
    </nav>

    <main class="page">
        <section class="page-header">
            <h1>Data Cafe</h1>
            <p>Daftar seluruh cafe yang tersedia sebagai alternatif pilihan.</p>
        </section>

        <section class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-mug-hot"></i></div>
                <div>
                    <h3>{{ $totalCafe }}</h3>
                    <p>Total Cafe</p>
                    <small>Jumlah seluruh cafe</small>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-border-all"></i></div>
                <div>
                    <h3>{{ $totalKriteria }}</h3>
                    <p>Kriteria</p>
                    <small>Suasana, harga, jarak, wifi</small>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon wp">WP</div>
                <div>
                    <h3>Weighted Product</h3>
                    <p>Metode SPK</p>
                    <small>Metode yang digunakan</small>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon"><i class="fa-regular fa-calendar"></i></div>
                <div>
                    <h3>{{ date('Y') }}</h3>
                    <p>Data Terbaru</p>
                    <small>Diperbarui otomatis</small>
                </div>
            </div>
        </section>

        <section class="toolbar">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Cari cafe...">
            </div>

            <select id="filterSelect">
                <option value="">Semua Cafe</option>
                <option value="murah">Harga Murah</option>
                <option value="wifi">Wifi Cepat</option>
                <option value="parkiran">Parkiran Luas</option>
            </select>
        </section>

        <section class="cafe-grid">
            @forelse ($cafes as $index => $cafe)
                <div class="cafe-card" data-name="{{ strtolower($cafe->nama_cafe) }}"
                    data-price="{{ $cafe->harga_menu }}" data-wifi="{{ $cafe->kecepatan_wifi }}"
                    data-parkiran="{{ $cafe->luas_parkiran }}">

                    <div class="image-wrap">
                        <span class="number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>

                        <img src="{{ $cafe->foto ? asset('storage/' . $cafe->foto) : 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=900&q=80' }}"
                            alt="{{ $cafe->nama_cafe }}">
                    </div>

                    <div class="card-content">
                        <h3>{{ $cafe->nama_cafe }}</h3>

                        <div class="badge-row">
                            <span>{{ $cafe->suasana >= 4 ? 'Nyaman' : 'Cukup Nyaman' }}</span>
                            <span>Rp {{ number_format($cafe->harga_menu, 0, ',', '.') }}</span>
                            <span>{{ $cafe->jarak }} km</span>
                        </div>

                        <div class="info-list">
                            <p><b>Luas Parkiran</b> {{ $cafe->luas_parkiran }} m²</p>
                            <p><b>Kecepatan Wifi</b> {{ $cafe->kecepatan_wifi }} Kbps</p>
                            <p><b>Jarak</b> {{ $cafe->jarak }} km</p>
                        </div>

                        <a href="{{ route('data.cafe.detail', $cafe->id_alternatif) }}" class="detail-btn">
                            Detail
                        </a>
                    </div>
                </div>
            @empty
                <div class="empty">
                    Belum ada cafe yang disetujui admin.
                </div>
            @endforelse
        </section>
    </main>

    <script>
        const searchInput = document.getElementById('searchInput');
        const filterSelect = document.getElementById('filterSelect');
        const cards = document.querySelectorAll('.cafe-card');

        function filterCafe() {
            const keyword = searchInput.value.toLowerCase();
            const filter = filterSelect.value;

            cards.forEach(card => {
                const name = card.dataset.name;
                const price = parseInt(card.dataset.price);
                const wifi = parseInt(card.dataset.wifi);
                const parkiran = parseInt(card.dataset.parkiran);

                let show = name.includes(keyword);

                if (filter === 'murah') {
                    show = show && price <= 25000;
                }

                if (filter === 'wifi') {
                    show = show && wifi >= 20000;
                }

                if (filter === 'parkiran') {
                    show = show && parkiran >= 80;
                }

                card.style.display = show ? 'block' : 'none';
            });
        }

        searchInput.addEventListener('input', filterCafe);
        filterSelect.addEventListener('change', filterCafe);
    </script>

</body>

</html>
