<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajukan Cafe
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
                <form action="{{ route('pemilik.cafe.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label>Nama Cafe</label><br>
                        <input type="text" name="nama_cafe" required style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>Nama Pemilik</label><br>
                        <input type="text" name="nama_pemilik" required style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>No HP</label><br>
                        <input type="text" name="no_hp" required style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>Alamat</label><br>
                        <textarea name="alamat" required style="width:100%;"></textarea>
                    </div>

                    <br>

                    <div>
                        <label>Foto Cafe</label><br>
                        <input type="file" name="foto">
                    </div>

                    <br>

                    <div class="md:col-span-2">
                        <label class="font-semibold">Daftar Menu dan Harga</label>

                        <div id="menu-wrapper" class="mt-3 space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 menu-item">
                                <input type="text" name="menu[0][nama_menu]"
                                       placeholder="Nama menu"
                                       class="w-full rounded-lg border-gray-300" required>

                                <input type="number" name="menu[0][harga]"
                                       placeholder="Harga menu"
                                       class="w-full rounded-lg border-gray-300 harga-menu" required>

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
                        <label>Luas Parkiran / m²</label><br>
                        <input type="number" name="luas_parkiran" required style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>Kecepatan Wifi / Kbps</label><br>
                        <input type="number" name="kecepatan_wifi" required style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>Jarak / KM</label><br>
                        <input type="number" name="jarak" required style="width:100%;">
                    </div>

                    <br>

                    <div>
                        <label>Suasana</label><br>
                        <select name="suasana" required style="width:100%;">
                            <option value="5">Sangat Nyaman</option>
                            <option value="4">Nyaman</option>
                            <option value="3">Cukup Nyaman</option>
                            <option value="2">Kurang Nyaman</option>
                            <option value="1">Tidak Nyaman</option>
                        </select>
                    </div>

                    <br>

                    <button type="submit"
                        style="background:#16a34a; color:white; padding:10px 15px; border-radius:6px;">
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
    </script>
</x-app-layout>