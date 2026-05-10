<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Detail Perhitungan WP - {{ $detail['nama_cafe'] }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ route('admin.perhitungan') }}"
               class="inline-block mb-5 bg-gray-700 text-white px-4 py-2 rounded">
                Kembali
            </a>

            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Normalisasi Bobot</h3>

                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 text-left">Kriteria</th>
                            <th class="py-3 text-left">Bobot Awal</th>
                            <th class="py-3 text-left">Tipe</th>
                            <th class="py-3 text-left">Bobot Normal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($bobotNormal as $bobot)
                            <tr class="border-b">
                                <td class="py-3">{{ $bobot['nama_kriteria'] }}</td>
                                <td class="py-3">{{ $bobot['bobot_asli'] }}</td>
                                <td class="py-3">{{ $bobot['tipe'] }}</td>
                                <td class="py-3">{{ number_format($bobot['bobot_normal'], 6) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Perhitungan Nilai S</h3>

                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 text-left">Kriteria</th>
                            <th class="py-3 text-left">Tipe</th>
                            <th class="py-3 text-left">Nilai</th>
                            <th class="py-3 text-left">Bobot Normal</th>
                            <th class="py-3 text-left">Nilai Pangkat</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($detail['rincian'] as $row)
                            <tr class="border-b">
                                <td class="py-3">{{ $row['nama_kriteria'] }}</td>
                                <td class="py-3">{{ $row['tipe'] }}</td>
                                <td class="py-3">{{ $row['bobot_tampil'] }}</td>
                                <td class="py-3">{{ number_format($row['bobot_normal'], 6) }}</td>
                                <td class="py-3">{{ number_format($row['nilai_pangkat'], 6) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-5 p-4 bg-gray-100 rounded">
                    <p>
                        <b>Nilai S:</b>
                        {{ number_format($detail['nilai_s'], 6) }}
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="font-bold text-lg mb-4">Perhitungan Nilai V</h3>

                <p class="mb-3">
                    Rumus:
                    <b>V = S / Total S</b>
                </p>

                <div class="p-4 bg-gray-100 rounded">
                    <p><b>Nilai S Cafe:</b> {{ number_format($detail['nilai_s'], 6) }}</p>
                    <p><b>Total S Semua Cafe:</b> {{ number_format($totalS, 6) }}</p>
                    <p><b>Nilai V:</b> {{ number_format($detail['nilai_v'], 6) }}</p>
                    <p><b>Ranking:</b> {{ $detail['ranking'] }}</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>