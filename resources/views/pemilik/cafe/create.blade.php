<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajukan Cafe
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">

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

                <form action="{{ route('pemilik.cafe.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Nama Cafe</label>
                        <input type="text" name="nama_cafe" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <br>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <br>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">No HP</label>
                        <input type="text" name="no_hp" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <br>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" required rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>

                    <br>

                    <!-- FOTO CAFE BARU -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Foto Cafe</label>

                        <div class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center bg-gray-50 hover:bg-gray-100 transition">
                            <input
                                type="file"
                                name="foto[]"
                                id="fotoCafe"
                                multiple
                                accept="image/*"
                                class="hidden"
                                onchange="previewFoto(event)"
                            >

                            <label for="fotoCafe" class="cursor-pointer block">
                                <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-3xl">
                                    📷
                                </div>

                                <p class="font-semibold text-gray-800">
                                    Klik untuk tambah gambar cafe
                                </p>

                                <p class="text-sm text-gray-500 mt-1">
                                    Bisa pilih lebih dari satu gambar. Format: JPG, PNG, JPEG, WEBP.
                                </p>

                                <span class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-sm">
                                    + Pilih Gambar
                                </span>
                            </label>
                        </div>

                        <div id="previewFoto" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4"></div>
                    </div>
                    <!-- END FOTO CAFE BARU -->

                    <br>

                    <div class="md:col-span-2">
                        <label class="font-semibold text-gray-700">Daftar Menu dan Harga</label>

                        <div id="menu-wrapper" class="mt-3 space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 menu-item">
                                <input type="text" name="menu[0][nama_menu]"
                                    placeholder="Nama menu"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>

                                <input type="number" name="menu[0][harga]"
                                    placeholder="Harga menu"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 harga-menu" required>

                                <button type="button"
                                    onclick="hapusMenu(this)"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                    Hapus
                                </button>
                            </div>
                        </div>

                        <button type="button" onclick="tambahMenu()"
                            class="mt-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                            + Tambah Menu
                        </button>

                        <div class="mt-4 p-4 bg-gray-100 rounded-lg">
                            <p class="font-semibold">Harga Rata-rata:</p>
                            <p id="harga-rata-rata">Rp 0</p>
                        </div>
                    </div>

                    <br>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Luas Parkiran / m²</label>
                        <input type="number" name="luas_parkiran" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <br>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Kecepatan Wifi / Kbps</label>
                        <input type="number" name="kecepatan_wifi" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <br>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">Lokasi Cafe</label>

                        <div id="map" style="height: 350px; width: 100%; border-radius: 12px; margin-top: 10px;"></div>

                        <input type="hidden" name="latitude" id="latitude" required>
                        <input type="hidden" name="longitude" id="longitude" required>
                        <input type="hidden" name="jarak" id="jarak" required>

                        <div class="mt-4 p-4 bg-gray-100 rounded-lg">
                            <p><b>Jarak dari Alun-alun Bondowoso:</b></p>
                            <p id="jarakText">Belum memilih lokasi</p>

                            <p class="mt-2"><b>Kriteria Jarak:</b></p>
                            <p id="kriteriaJarak">-</p>
                        </div>

                        <div class="mt-5 border border-gray-200 rounded-2xl p-5">
                            <h3 class="text-xl font-bold mb-4">Kriteria Jarak</h3>

                            <div class="overflow-x-auto">
                                <table class="w-full border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="p-3 text-left">Pilihan</th>
                                            <th class="p-3 text-left">Range Jarak</th>
                                            <th class="p-3 text-left">Bobot</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr class="border-b">
                                            <td class="p-3">Dekat</td>
                                            <td class="p-3">&lt; 1 km</td>
                                            <td class="p-3">3</td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="p-3">Sedang</td>
                                            <td class="p-3">1 km - 3 km</td>
                                            <td class="p-3">2</td>
                                        </tr>
                                        <tr>
                                            <td class="p-3">Jauh</td>
                                            <td class="p-3">&gt; 3 km</td>
                                            <td class="p-3">1</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div>
                        <label class="block font-semibold text-gray-700 mb-1">Suasana</label>
                        <select name="suasana" required
                            class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <option value="3">Nyaman</option>
                            <option value="2">Sedang</option>
                            <option value="1">Tidak Nyaman</option>
                        </select>
                    </div>

                    <br>

                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow-sm">
                        Simpan Pengajuan
                    </button>

                </form>

            </div>
        </div>
    </div>

    <script>
        let indexMenu = 1;

        function tambahMenu() {
            const wrapper = document.getElementById('menu-wrapper');

            const html = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 menu-item">
                    <input type="text" name="menu[${indexMenu}][nama_menu]"
                        placeholder="Nama menu"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500" required>

                    <input type="number" name="menu[${indexMenu}][harga]"
                        placeholder="Harga menu"
                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 harga-menu" required>

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

        let semuaFoto = [];

        function previewFoto(event) {
            const filesBaru = Array.from(event.target.files);

            semuaFoto = semuaFoto.concat(filesBaru);

            tampilkanPreviewFoto();
            updateInputFoto();
        }

        function tampilkanPreviewFoto() {
            const preview = document.getElementById('previewFoto');
            preview.innerHTML = '';

            semuaFoto.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative rounded-xl overflow-hidden shadow border bg-white';

                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover">

                        <div class="p-2">
                            <p class="text-xs text-gray-600 truncate">${file.name}</p>
                        </div>

                        <button type="button"
                            onclick="hapusFoto(${index})"
                            class="absolute top-2 left-2 bg-red-600 hover:bg-red-700 text-white text-xs px-2 py-1 rounded-full">
                            X
                        </button>

                        <span class="absolute top-2 right-2 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded-full">
                            ${index + 1}
                        </span>
                    `;

                    preview.appendChild(div);
                };

                reader.readAsDataURL(file);
            });
        }

        function hapusFoto(index) {
            semuaFoto.splice(index, 1);
            tampilkanPreviewFoto();
            updateInputFoto();
        }

        function updateInputFoto() {
            const input = document.getElementById('fotoCafe');
            const dataTransfer = new DataTransfer();

            semuaFoto.forEach(file => {
                dataTransfer.items.add(file);
            });

            input.files = dataTransfer.files;
        }
    </script>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const alunAlun = {
            lat: -7.9131382,
            lng: 113.8225832
        };

        const map = L.map('map').setView([alunAlun.lat, alunAlun.lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        L.marker([alunAlun.lat, alunAlun.lng])
            .addTo(map)
            .bindPopup('Alun-alun Bondowoso')
            .openPopup();

        let cafeMarker = null;

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