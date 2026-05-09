<x-app-layout>
    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-4xl font-bold text-slate-900 mt-2">
                    Hasil Perhitungan Weighted Product
                </h1>

                <p class="text-slate-500 mt-3">
                    Lihat ranking cafe berdasarkan hasil perhitungan metode Weighted Product.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Ranking</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Nama Cafe</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Nilai S</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Nilai V</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($hasil as $row)
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                    <td class="py-5 px-4">
                                        {{ $row['ranking'] }}
                                    </td>

                                    <td class="py-5 px-4 font-semibold text-slate-900">
                                        {{ $row['nama_cafe'] }}
                                    </td>

                                    <td class="py-5 px-4 text-slate-700">
                                        {{ number_format($row['nilai_s'], 6) }}
                                    </td>

                                    <td class="py-5 px-4 font-bold text-slate-900">
                                        {{ number_format($row['nilai_v'], 6) }}
                                    </td>

                                    <td class="py-5 px-4">
                                        <a href="{{ route('admin.perhitungan.detail', $row['id_alternatif']) }}"
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-bold transition inline-block">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-10 text-center text-slate-500">
                                        Belum ada cafe approved atau data penilaian belum lengkap.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
