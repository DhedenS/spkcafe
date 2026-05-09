<x-app-layout>
    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-4xl font-bold text-slate-900 mt-2">
                    History Hasil
                </h1>

                <p class="text-slate-500 mt-3">
                    Riwayat pencarian rekomendasi cafe berdasarkan preferensi user.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">No</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Waktu</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Suasana</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Harga</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Jarak</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Parkiran</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Wifi</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Hasil Cafe</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($histories as $history)
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                    <td class="py-5 px-4 text-slate-700">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="py-5 px-4 text-slate-700 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($history->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}
                                    </td>

                                    <td class="py-5 px-4 text-slate-700">{{ $history->suasana }}</td>
                                    <td class="py-5 px-4 text-slate-700">{{ $history->harga }}</td>
                                    <td class="py-5 px-4 text-slate-700">{{ $history->jarak }}</td>
                                    <td class="py-5 px-4 text-slate-700">{{ $history->parkiran }}</td>
                                    <td class="py-5 px-4 text-slate-700">{{ $history->wifi }}</td>

                                    <td class="py-5 px-4 font-bold text-slate-900">
                                        {{ $history->nama_cafe ?? $history->hasil_cafe }}
                                    </td>

                                    <td class="py-5 px-4">
                                        @if ($history->id_alternatif)
                                            <a href="{{ route('admin.history.detail', $history->id_history) }}"
                                               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl font-bold transition inline-block">
                                                Detail
                                            </a>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="py-10 text-center text-slate-500">
                                        Belum ada history pencarian.
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
