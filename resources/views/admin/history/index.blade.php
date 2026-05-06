<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            History Hasil Rekomendasi
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow p-6">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 text-left">No</th>
                            <th class="py-3 text-left">Waktu</th>
                            <th class="py-3 text-left">Suasana</th>
                            <th class="py-3 text-left">Harga</th>
                            <th class="py-3 text-left">Jarak</th>
                            <th class="py-3 text-left">Parkiran</th>
                            <th class="py-3 text-left">Wifi</th>
                            <th class="py-3 text-left">Hasil Cafe</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($histories as $history)
                            <tr class="border-b">
                                <td class="py-3">{{ $loop->iteration }}</td>
                                <td class="py-3">
                                    {{ \Carbon\Carbon::parse($history->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}
                                </td>
                                <td class="py-3">{{ $history->suasana }}</td>
                                <td class="py-3">{{ $history->harga }}</td>
                                <td class="py-3">{{ $history->jarak }}</td>
                                <td class="py-3">{{ $history->parkiran }}</td>
                                <td class="py-3">{{ $history->wifi }}</td>
                                <td class="py-3 font-semibold">
                                    {{ $history->nama_cafe ?? $history->hasil_cafe }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-6 text-center text-gray-500">
                                    Belum ada history pencarian.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
