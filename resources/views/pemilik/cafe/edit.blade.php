<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Cafe
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div style="background:white; padding:20px; border-radius:10px;">

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                        <strong>Data belum valid:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pemilik.cafe.update', $cafe->id_alternatif) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label>Nama Cafe</label><br>
                        <input type="text"
                               name="nama_cafe"
                               value="{{ old('nama_cafe', $cafe->nama_cafe) }}"
                               required
                               style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>Nama Pemilik</label><br>
                        <input type="text"
                               name="nama_pemilik"
                               value="{{ old('nama_pemilik', $cafe->nama_pemilik) }}"
                               required
                               style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>No HP</label><br>
                        <input type="text"
                               name="no_hp"
                               value="{{ old('no_hp', $cafe->no_hp) }}"
                               required
                               style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>Alamat</label><br>
                        <textarea name="alamat" required style="width:100%;">{{ old('alamat', $cafe->alamat) }}</textarea>
                    </div>

                    <br>

                    <div>
                        <label>Foto Cafe</label><br>
                        <input type="file" name="foto">

                        @if ($cafe->foto)
                            <div style="margin-top:10px;">
                                <img src="{{ asset('storage/'.$cafe->foto) }}"
                                     alt="Foto Cafe"
                                     style="width:180px; height:120px; object-fit:cover; border-radius:10px;">
                            </div>
                        @endif
                    </div>

                    <br>

                    <div class="md:col-span-2">
                        <label class="font-semibold">Daftar Menu dan Harga</label>

                        <div id="menu-wrapper" class="mt-3 space-y-3">
                            @forelse ($cafe->menu as $index => $menu)
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 menu-item">
                                    <input type="text"
                                           name="menu[{{ $index }}][nama_menu]"
                                           value="{{ $menu->nama_menu }}"
                                           placeholder="Nama menu"
                                           class="w-full rounded-lg border-gray-300"
                                           required>

                                    <input type="number"
                                           name="menu[{{ $index }}][harga]"
                                           value="{{ $menu->harga }}"
                                           placeholder="Harga menu"
                                           class="w-full rounded-lg border-gray-300 harga-menu"
                                           required>

                                    <button type="button"
                                            onclick="hapusMenu(this)"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                        Hapus
                                    </button>
                                </div>
                            @empty
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 menu-item">
                                    <input type="text"
                                           name="menu[0][nama_menu]"
                                           placeholder="Nama menu"
                                           class="w-full rounded-lg border-gray-300"
                                           required>

                                    <input type="number"
                                           name="menu[0][harga]"
                                           placeholder="Harga menu"
                                           class="w-full rounded-lg border-gray-300 harga-menu"
                                           required>

                                    <button type="button"
                                            onclick="hapusMenu(this)"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                        Hapus
                                    </button>
                                </div>
                            @endforelse
                        </div>

                        <button type="button" onclick="tambahMenu()"
                            class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            + Tambah Menu
                        </button>

                        <div class="mt-4 p-4 bg-gray-100 rounded-lg">
                            <p class="font-semibold">Harga Rata-rata:</p>
                            <p id="harga-rata-rata">
                                Rp {{ number_format($cafe->harga_menu, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <br>

                    <div>
                        <label>Luas Parkiran / m²</label><br>
                        <input type="number"
                               name="luas_parkiran"
                               value="{{ old('luas_parkiran', $cafe->luas_parkiran) }}"
                               required
                               style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>Kecepatan Wifi / Kbps</label><br>
                        <input type="number"
                               name="kecepatan_wifi"
                               value="{{ old('kecepatan_wifi', $cafe->kecepatan_wifi) }}"
                               required
                               style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>Lokasi Cafe</label>

                        <div id="map" style="height: 350px; width: 100%; border-radius: 12px; margin-top: 10px;"></div>

                        <input type="hidden"
                               name="latitude"
                               id="latitude"
                               value="{{ old('latitude', $cafe->latitude) }}"
                               required>

                        <input type="hidden"
                               name="longitude"
                               id="longitude"
                               value="{{ old('longitude', $cafe->longitude) }}"
                               required>

                        <input type="hidden"
                               name="jarak"
                               id="jarak"
                               value="{{ old('jarak', $cafe->jarak) }}"
                               required>

                        <div style="margin-top: 15px; padding: 15px; background: #f3f4f6; border-radius: 10px;">
                            <p><b>Jarak dari Alun-alun Bondowoso:</b></p>
                            <p id="jarakText">
                                {{ $cafe->jarak ? $cafe->jarak.' km' : 'Belum memilih lokasi' }}
                            </p>

                            <p style="margin-top: 8px;"><b>Kriteria Jarak:</b></p>
                            <p id="kriteriaJarak">-</p>
                        </div>

                        <div style="margin-top: 20px; border:1px solid #e5e7eb; border-radius:16px; padding:20px;">
                            <h3 style="font-size:22px; font-weight:bold; margin-bottom:15px;">Kriteria Jarak</h3>

                            <table style="width:100%; border-collapse:collapse;">
                                <thead>
                                    <tr style="background:#f3f4f6;">
                                        <th style="padding:12px; text-align:left;">Pilihan</th>
                                        <th style="padding:12px; text-align:left;">Range Jarak</th>
                                        <th style="padding:12px; text-align:left;">Bobot</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td style="padding:12px;">Dekat</td>
                                        <td style="padding:12px;">&lt; 1 km</td>
                                        <td style="padding:12px;">3</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:12px;">Sedang</td>
                                        <td style="padding:12px;">1 km - 3 km</td>
                                        <td style="padding:12px;">2</td>
                                    </tr>
                                    <tr>
                                        <td style="padding:12px;">Jauh</td>
                                        <td style="padding:12px;">&gt; 3 km</td>
                                        <td style="padding:12px;">1</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>

                    <div>
                        <label>Suasana</label><br>
                        <select name="suasana" required style="width:100%;">
                            <option value="3" {{ old('suasana', $cafe->suasana) == 3 ? 'selected' : '' }}>
                                Nyaman
                            </option>
                            <option value="2" {{ old('suasana', $cafe->suasana) == 2 ? 'selected' : '' }}>
                                Sedang
                            </option>
                            <option value="1" {{ old('suasana', $cafe->suasana) == 1 ? 'selected' : '' }}>
                                Tidak Nyaman
                            </option>
                        </select>
                    </div>

                    <br>

                    <button type="submit"
                        style="background:#16a34a; color:white; padding:10px 15px; border-radius:6px;">
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('pemilik.cafe') }}"
                       style="margin-left:10px; color:#374151;">
                        Kembali
                    </a>

                </form>

            </div>
        </div>
    </div>

    <script>
        let indexMenu = {{ $cafe->menu->count() > 0 ? $cafe->menu->count() : 1 }};

        function tambahMenu() {
            const wrapper = document.getElementById('menu-wrapper');

            const html = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 menu-item">
                    <input type="text" name="menu[${indexMenu}][nama_menu]"
                           placeholder="Nama menu"
                           class="w-full rounded-lg border-gray-300" required>

                    <input type="number" name="menu[${indexMenu}][harga]"
                           placeholder="Harga menu"
                           class="w-full rounded-lg border-gray-300 harga-menu" required>

                    <button type="button"
                            onclick="hapusMenu(this)"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                        Hapus
                    </button>
                </div>
            `;

            wrapper.insertAdjacentHTML('beforeend', html);
            indexMenu++;
            hitungRataRata();
        }

        function hapusMenu(button) {
            const wrapper = document.getElementById('menu-wrapper');
            const items = wrapper.querySelectorAll('.menu-item');

            if (items.length <= 1) {
                alert('Minimal harus ada 1 menu.');
                return;
            }

            button.closest('.menu-item').remove();
            hitungRataRata();
        }

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('harga-menu')) {
                hitungRataRata();
            }
        });

        function hitungRataRata() {
            const inputs = document.querySelectorAll('.harga-menu');
            let total = 0;
            let jumlah = 0;

            inputs.forEach(input => {
                let nilai = parseInt(input.value);

                if (!isNaN(nilai) && nilai > 0) {
                    total += nilai;
                    jumlah++;
                }
            });

            let rata = jumlah > 0 ? total / jumlah : 0;

            document.getElementById('harga-rata-rata').innerText =
                'Rp ' + Math.round(rata).toLocaleString('id-ID');
        }

        document.addEventListener('DOMContentLoaded', function() {
            hitungRataRata();
        });
    </script>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const alunAlun = {
            lat: -7.9131382,
            lng: 113.8225832
        };

        const cafeLat = {{ $cafe->latitude ? $cafe->latitude : '-7.9131382' }};
        const cafeLng = {{ $cafe->longitude ? $cafe->longitude : '113.8225832' }};

        const map = L.map('map').setView([cafeLat, cafeLng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        L.marker([alunAlun.lat, alunAlun.lng])
            .addTo(map)
            .bindPopup('Alun-alun Bondowoso');

        let cafeMarker = null;

        if ({{ $cafe->latitude && $cafe->longitude ? 'true' : 'false' }}) {
            cafeMarker = L.marker([cafeLat, cafeLng])
                .addTo(map)
                .bindPopup('Lokasi Cafe')
                .openPopup();

            const jarakAwal = parseFloat(document.getElementById('jarak').value);

            if (!isNaN(jarakAwal)) {
                const kriteriaAwal = tentukanKriteriaJarak(jarakAwal);

                document.getElementById('kriteriaJarak').innerText =
                    kriteriaAwal.label + ' | Bobot: ' + kriteriaAwal.bobot;
            }
        }

        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            if (cafeMarker) {
                cafeMarker.setLatLng([lat, lng]);
            } else {
                cafeMarker = L.marker([lat, lng]).addTo(map);
            }

            cafeMarker.bindPopup('Lokasi Cafe').openPopup();

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            const jarak = hitungJarak(alunAlun.lat, alunAlun.lng, lat, lng);
            const jarakBulat = jarak.toFixed(2);

            document.getElementById('jarak').value = jarakBulat;
            document.getElementById('jarakText').innerText = jarakBulat + ' km';

            const kriteria = tentukanKriteriaJarak(jarak);

            document.getElementById('kriteriaJarak').innerText =
                kriteria.label + ' | Bobot: ' + kriteria.bobot;
        });

        function hitungJarak(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const dLat = toRad(lat2 - lat1);
            const dLon = toRad(lon2 - lon1);

            const a =
                Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);

            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            return R * c;
        }

        function toRad(value) {
            return value * Math.PI / 180;
        }

        function tentukanKriteriaJarak(jarak) {
            if (jarak < 1) {
                return {
                    label: 'Dekat (< 1 km)',
                    bobot: 3
                };
            }

            if (jarak <= 3) {
                return {
                    label: 'Sedang (1 km - 3 km)',
                    bobot: 2
                };
            }

            return {
                label: 'Jauh (> 3 km)',
                bobot: 1
            };
        }
    </script>
</x-app-layout>