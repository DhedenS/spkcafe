<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rekomendasi Cafe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar">
        <div class="nav-brand">
            <img src="{{ asset('assets/logo-five.png') }}" alt="Logo">
            <span>Rekomendasi Cafe</span>
        </div>

        <div class="nav-menu">
            <a href="/">Dashboard</a>
            <a href="{{ route('data.cafe') }}">Data Cafe</a>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-left">
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
                <img src="https://images.unsplash.com/photo-1493857671505-72967e2e2760?auto=format&fit=crop&w=900&q=80"
                    alt="Cafe">
            </div>
        </div>
    </section>

    <section class="why-section">
        <img src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?auto=format&fit=crop&w=900&q=80"
            alt="Cafe">

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

        <form id="formRekomendasi" class="filter-form">
            @csrf

            <div class="filter-group">
                <label>Suasana</label>
                <select name="suasana" required>
                    <option value="">Pilih suasana</option>
                    <option value="1">Biasa</option>
                    <option value="2">Nyaman</option>
                    <option value="3">Sangat Nyaman</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Harga</label>
                <select name="harga" required>
                    <option value="">Pilih harga</option>
                    <option value="3">Murah</option>
                    <option value="2">Sedang</option>
                    <option value="1">Mahal</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Jarak</label>
                <select name="jarak" required>
                    <option value="">Pilih jarak</option>
                    <option value="3">Dekat</option>
                    <option value="2">Sedang</option>
                    <option value="1">Jauh</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Parkiran</label>
                <select name="parkiran" required>
                    <option value="">Pilih parkiran</option>
                    <option value="1">Kecil</option>
                    <option value="2">Sedang</option>
                    <option value="3">Luas</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Wifi</label>
                <select name="wifi" required>
                    <option value="">Pilih wifi</option>
                    <option value="1">Lambat</option>
                    <option value="2">Sedang</option>
                    <option value="3">Cepat</option>
                </select>
            </div>

            <button type="submit" class="btn-cari">
                <i class="fa-solid fa-magnifying-glass"></i>
                Cari Rekomendasi
            </button>
        </form>
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
            <a href="{{ route('data.cafe') }}">Data Cafe</a>
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

    <div id="modalRekomendasi" class="modal-overlay">
        <div class="modal-box modal-large">
            <button class="modal-close" onclick="closeModalRekomendasi()">×</button>

            <span class="modal-label">HASIL REKOMENDASI</span>
            <h2>Top 10 Cafe Terbaik</h2>
            <p class="modal-subtitle">Klik salah satu cafe untuk melihat detail lengkap.</p>

            <div id="hasilRekomendasi" class="recommendation-list"></div>
        </div>
    </div>

    <div id="modalDetailCafe" class="modal-overlay">
        <div class="modal-box modal-detail">
            <button class="modal-close" onclick="closeModalDetail()">×</button>

            <div id="detailCafeContent"></div>
        </div>
    </div>

    <script>
        const formRekomendasi = document.getElementById('formRekomendasi');

        formRekomendasi.addEventListener('submit', async function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            const response = await fetch("{{ route('rekomendasi.ajax') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json",
                },
                body: formData
            });

            const result = await response.json();

            let html = '';

            if (result.data.length === 0) {
                html = `<p class="empty-modal">Belum ada cafe yang cocok.</p>`;
            } else {
                result.data.forEach((item, index) => {
                    html += `
                    <div class="recommendation-item" onclick="openDetailCafe('${item.id_alternatif}')">
                        <div class="rank-badge">#${index + 1}</div>

                        <img src="${item.foto}" alt="${item.nama_cafe}">

                        <div class="recommendation-info">
                            <h3>${item.nama_cafe}</h3>
                            <p>${item.alamat ?? '-'}</p>

                            <div class="recommendation-meta">
                                <span>Nilai V: ${item.nilai_v}</span>
                                <span>Rp ${item.harga_menu}</span>
                                <span>${item.jarak} km</span>
                            </div>
                        </div>

                        <div class="recommendation-score">
                            <b>${item.nilai_v}</b>
                            <small>Skor WP</small>
                        </div>
                    </div>
                `;
                });
            }

            document.getElementById('hasilRekomendasi').innerHTML = html;
            document.getElementById('modalRekomendasi').classList.add('show');
        });

        function closeModalRekomendasi() {
            document.getElementById('modalRekomendasi').classList.remove('show');
        }

        async function openDetailCafe(id) {
            const response = await fetch(`/cafe-detail/${id}`);
            const cafe = await response.json();

            let menuHtml = '';

            cafe.menu.forEach(menu => {
                menuHtml += `
                <li>
                    <span>${menu.nama_menu}</span>
                    <b>Rp ${menu.harga}</b>
                </li>
            `;
            });

            document.getElementById('detailCafeContent').innerHTML = `
            <div class="detail-grid">
                <div>
                    <img src="${cafe.foto}" class="detail-main-img">

                    <div class="detail-gallery">
                        <img src="${cafe.foto}">
                        <img src="${cafe.foto}">
                        <img src="${cafe.foto}">
                    </div>
                </div>

                <div>
                    <span class="modal-label">DETAIL CAFE</span>
                    <h2>${cafe.nama_cafe}</h2>
                    <p class="detail-address">${cafe.alamat ?? '-'}</p>

                    <div class="detail-spec">
                        <p><i class="fa-solid fa-couch"></i> Suasana <b>${cafe.suasana}/5</b></p>
                        <p><i class="fa-solid fa-tag"></i> Harga Rata-rata <b>Rp ${cafe.harga_menu}</b></p>
                        <p><i class="fa-solid fa-location-dot"></i> Jarak <b>${cafe.jarak} km</b></p>
                        <p><i class="fa-solid fa-car"></i> Parkiran <b>${cafe.parkiran} m²</b></p>
                        <p><i class="fa-solid fa-wifi"></i> Wifi <b>${cafe.wifi} Kbps</b></p>
                    </div>

                    <h3 class="menu-title">Daftar Menu</h3>
                    <ul class="menu-list">
                        ${menuHtml}
                    </ul>
                </div>
            </div>
        `;

            document.getElementById('modalDetailCafe').classList.add('show');
        }

        function closeModalDetail() {
            document.getElementById('modalDetailCafe').classList.remove('show');
        }
    </script>
</body>

</html>
