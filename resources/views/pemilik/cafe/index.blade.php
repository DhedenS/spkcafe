<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Cafe Saya
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('pemilik.cafe.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-block mb-4">
                + Ajukan Cafe
            </a>

            <div class="bg-white rounded-2xl shadow p-6 overflow-x-auto">
                <table class="w-full min-w-[900px]">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Nama Cafe</th>
                            <th class="px-4 py-3 text-left">Alamat</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Harga Rata-Rata</th>
                            <th class="px-4 py-3 text-left">Wifi</th>
                            <th class="px-4 py-3 text-left">Parkiran</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($cafes as $cafe)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-4">{{ $loop->iteration }}</td>

                                <td class="px-4 py-4 font-semibold">
                                    {{ $cafe->nama_cafe }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $cafe->alamat }}
                                </td>

                                <td class="px-4 py-4">
                                    @if ($cafe->status == 'approved')
                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                            Approved
                                        </span>
                                    @elseif ($cafe->status == 'pending')
                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-semibold">
                                            Pending
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-semibold">
                                            Rejected
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-4">
                                    Rp {{ number_format($cafe->harga_menu, 0, ',', '.') }}
                                </td>

                                <td class="px-4 py-4">
                                    {{ $cafe->kecepatan_wifi }} Kbps
                                </td>

                                <td class="px-4 py-4">
                                    {{ $cafe->luas_parkiran }} m²
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-500">
                                    Belum ada cafe yang diajukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
