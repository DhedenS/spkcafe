<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SPK Cafe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
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
        <a href="{{ route('data.cafe') }}">Data Cafe</a>
        <a href="/login" class="login-icon">
            <i class="fa-regular fa-user"></i>
        </a>
    </div>
</nav>

<section class="hero">
    <div class="hero-left">
        <div class="badge">SPK Rekomendasi Cafe</div>

        <h1>Temukan Cafe<br>Terbaik di Bondowoso</h1>

        <p>
            Temukan cafe terbaik sesuai kebutuhanmu dengan rekomendasi cerdas
            berdasarkan suasana, harga, jarak, luas parkiran, dan kecepatan wifi.
        </p>

        <div class="hero-buttons">
            <a href="#rekomendasi" class="btn-primary">
                Mulai Rekomendasi <i class="fa-solid fa-arrow-right"></i>
            </a>

            <a href="{{ route('data.cafe') }}" class="btn-outline">
                Lihat Data Cafe <i class="fa-solid fa-mug-hot"></i>
            </a>
        </div>
    </div>

    <div class="hero-right">
        <div class="hero-image-card">
            <img src="https://images.unsplash.com/photo-1493857671505-72967e2e2760?auto=format&fit=crop&w=900&q=80" alt="Cafe">
        </div>
    </div>
</section>

<section class="feature-card">
    <div class="feature-item">
        <i class="fa-solid fa-couch"></i>
        <h4>Suasana Nyaman</h4>
        <p>Rekomendasi cafe dengan suasana terbaik.</p>
    </div>

    <div class="feature-item">
        <i class="fa-solid fa-tag"></i>
        <h4>Harga Sesuai</h4>
        <p>Pilihan cafe sesuai budget mahasiswa.</p>
    </div>

    <div class="feature-item">
        <i class="fa-solid fa-location-dot"></i>
        <h4>Lokasi Strategis</h4>
        <p>Menyesuaikan jarak dari lokasimu.</p>
    </div>

    <div class="feature-item">
        <i class="fa-solid fa-car"></i>
        <h4>Parkiran Luas</h4>
        <p>Memilih cafe dengan parkiran memadai.</p>
    </div>

    <div class="feature-item">
        <i class="fa-solid fa-wifi"></i>
        <h4>Wifi Cepat</h4>
        <p>Rekomendasi berdasarkan kecepatan wifi.</p>
    </div>
</section>

<section id="rekomendasi" class="recommendation-box">
    <span>SPK REKOMENDASI</span>
    <h2>Temukan Cafe Terbaik Untuk Anda</h2>
    <p>Rekomendasi cafe terbaik berbasis perhitungan metode Weighted Product</p>

    <form method="GET" action="/" class="filter-form">
        <select name="suasana">
            <option value="">Suasana</option>
            <option value="5">Sangat Nyaman</option>
            <option value="4">Nyaman</option>
            <option value="3">Cukup Nyaman</option>
            <option value="2">Kurang Nyaman</option>
            <option value="1">Tidak Nyaman</option>
        </select>

        <select name="harga">
            <option value="">Harga</option>
            <option value="1">Murah</option>
            <option value="2">Sedang</option>
            <option value="3">Mahal</option>
        </select>

        <select name="jarak">
            <option value="">Jarak</option>
            <option value="1">Dekat</option>
            <option value="2">Sedang</option>
            <option value="3">Jauh</option>
        </select>

        <select name="parkiran">
            <option value="">Parkiran</option>
            <option value="5">Sangat Luas</option>
            <option value="4">Luas</option>
            <option value="3">Sedang</option>
            <option value="2">Kecil</option>
            <option value="1">Sempit</option>
        </select>

        <select name="wifi">
            <option value="">Wifi</option>
            <option value="5">Sangat Cepat</option>
            <option value="4">Cepat</option>
            <option value="3">Sedang</option>
            <option value="2">Lambat</option>
            <option value="1">Sangat Lambat</option>
        </select>

        <button type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
            Cari Rekomendasi
        </button>
    </form>
</section>

<section class="workflow">
    <span>CARA KERJA SPK</span>
    <h2>Bagaimana Sistem Ini Bekerja?</h2>
    <p>Sistem akan menghitung dan memberikan rekomendasi terbaik berdasarkan preferensi yang kamu pilih.</p>

    <div class="workflow-grid">
        <div class="workflow-item">
            <div class="circle"><i class="fa-solid fa-list"></i></div>
            <h4>1. Pilih Preferensi</h4>
            <p>Kamu memilih preferensi pada setiap kriteria.</p>
        </div>

        <div class="workflow-item">
            <div class="circle"><i class="fa-solid fa-calculator"></i></div>
            <h4>2. Proses Perhitungan</h4>
            <p>Sistem menghitung nilai menggunakan metode WP.</p>
        </div>

        <div class="workflow-item">
            <div class="circle"><i class="fa-solid fa-ranking-star"></i></div>
            <h4>3. Perangkingan</h4>
            <p>Cafe diurutkan berdasarkan nilai tertinggi.</p>
        </div>

        <div class="workflow-item">
            <div class="circle"><i class="fa-regular fa-star"></i></div>
            <h4>4. Rekomendasi Terbaik</h4>
            <p>Sistem menampilkan cafe terbaik sesuai preferensi.</p>
        </div>
    </div>
</section>


<section class="why-section">
    <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?auto=format&fit=crop&w=900&q=80" alt="Cafe">

    <div>
        <span>KENAPA MEMILIH SPK CAFE?</span>
        <h2>Keputusan Tepat, Pengalaman Maksimal</h2>
        <p>
            SPK Cafe membantu kamu menemukan tempat terbaik untuk bersantai,
            bekerja, atau berkumpul bersama teman.
        </p>

        <ul>
            <li><i class="fa-solid fa-check"></i> Rekomendasi objektif dan akurat</li>
            <li><i class="fa-solid fa-check"></i> Mempertimbangkan banyak kriteria penting</li>
            <li><i class="fa-solid fa-check"></i> Hemat waktu dalam memilih cafe</li>
            <li><i class="fa-solid fa-check"></i> Cocok untuk kebutuhan mahasiswa</li>
        </ul>
    </div>
</section>

<footer>
    <div>
        <div class="footer-brand">
            <img src="{{ asset('assets/logo-five.png') }}" alt="Logo">
            <span>SPK Cafe</span>
        </div>
        <p>Sistem Pendukung Keputusan untuk membantu menemukan cafe terbaik di Bondowoso.</p>
    </div>

    <div>
        <h4>Menu</h4>
        <a href="/">Dashboard</a>
        <a href="#data-cafe">Data Cafe</a>
    </div>

    <div>
        <h4>Kontak</h4>
        <p><i class="fa-solid fa-location-dot"></i> Bondowoso, Jawa Timur</p>
        <p><i class="fa-regular fa-envelope"></i> spkcafe@example.com</p>
    </div>
</footer>

<div class="copyright">
    © 2026 SPK Cafe. All rights reserved.
</div>

</body>
</html>