<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail History Rekomendasi
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('admin.history') }}"
               class="bg-slate-700 text-white px-4 py-2 rounded-lg inline-block mb-6">
                Kembali
            </a>

            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <h3 class="text-xl font-bold mb-4">Informasi Pencarian</h3>

                <table class="w-full">
                    <tr class="border-b">
                        <td class="py-3 font-semibold">Waktu</td>
                        <td class="py-3">
                            {{ \Carbon\Carbon::parse($history->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3 font-semibold">Hasil Cafe</td>
                        <td class="py-3 font-bold">
                            {{ $history->nama_cafe ?? $history->hasil_cafe }}
                        </td>
                    </tr>

                    <tr>
                        <td class="py-3 font-semibold">Alamat</td>
                        <td class="py-3">
                            {{ $history->alamat ?? '-' }}
                        </td>
                    </tr>
                </table>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <h3 class="text-xl font-bold mb-4">Detail Bobot Preferensi dan Normalisasi</h3>

                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 text-left">Kriteria</th>
                            <th class="py-3 text-left">Pilihan User</th>
                            <th class="py-3 text-left">Nilai Bobot</th>
                            <th class="py-3 text-left">Tipe</th>
                            <th class="py-3 text-left">Bobot Normal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($detail as $item)
                            @php
                                $normal = $bobotNormal[$item['id_kriteria']] ?? null;
                            @endphp

                            <tr class="border-b">
                                <td class="py-3">{{ $item['kriteria'] }}</td>
                                <td class="py-3">{{ $item['pilihan'] }}</td>
                                <td class="py-3 font-bold">{{ $item['nilai'] }}</td>
                                <td class="py-3">{{ $normal['tipe'] ?? '-' }}</td>
                                <td class="py-3">
                                    {{ $normal ? number_format($normal['bobot_normal'], 6) : '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <h3 class="text-xl font-bold mb-4">Perhitungan Nilai S</h3>

                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 text-left">Kriteria</th>
                            <th class="py-3 text-left">Tipe</th>
                            <th class="py-3 text-left">Nilai Cafe</th>
                            <th class="py-3 text-left">Bobot Normal</th>
                            <th class="py-3 text-left">Nilai Pangkat</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($perhitunganS as $row)
                            <tr class="border-b">
                                <td class="py-3">{{ $row['kriteria'] }}</td>
                                <td class="py-3">{{ $row['tipe'] }}</td>
                                <td class="py-3">{{ $row['nilai'] }}</td>
                                <td class="py-3">{{ number_format($row['bobot_normal'], 6) }}</td>
                                <td class="py-3">{{ number_format($row['nilai_pangkat'], 6) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="bg-gray-100 p-4 rounded-lg mt-4">
                    <b>Nilai S:</b> {{ number_format($nilaiS, 6) }}
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-xl font-bold mb-4">Perhitungan Nilai V</h3>

                <p class="mb-4">Rumus: <b>V = S / Total S</b></p>

                <div class="bg-gray-100 p-4 rounded-lg">
                    <p><b>Nilai S Cafe:</b> {{ number_format($nilaiS, 6) }}</p>
                    <p><b>Total S Semua Cafe:</b> {{ number_format($totalS, 6) }}</p>
                    <p><b>Nilai V:</b> {{ number_format($nilaiV, 6) }}</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
