<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Hasil Perhitungan Weighted Product
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow p-6">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 text-left">Ranking</th>
                            <th class="py-3 text-left">Nama Cafe</th>
                            <th class="py-3 text-left">Nilai S</th>
                            <th class="py-3 text-left">Nilai V</th>
                            <th class="py-3 text-left">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($hasil as $row)
                            <tr class="border-b">
                                <td class="py-3 font-bold">
                                    {{ $row['ranking'] }}
                                </td>

                                <td class="py-3">
                                    {{ $row['nama_cafe'] }}
                                </td>

                                <td class="py-3">
                                    {{ number_format($row['nilai_s'], 6) }}
                                </td>

                                <td class="py-3 font-semibold">
                                    {{ number_format($row['nilai_v'], 6) }}
                                </td>

                                <td class="py-3">
                                    <a href="{{ route('admin.perhitungan.detail', $row['id_alternatif']) }}"
                                       class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-5 text-center text-gray-500">
                                    Belum ada cafe approved atau data penilaian belum lengkap.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>