<x-app-layout>
    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="mb-8">
                <span class="text-sm font-semibold text-slate-500 uppercase tracking-widest">
                    Pemilik Cafe
                </span>

                <h1 class="text-4xl font-bold text-slate-900 mt-2">
                    Data Cafe Saya
                </h1>

                <p class="text-slate-500 mt-3">
                    Kelola data cafe, status approval, dan informasi cafe anda.
                </p>
            </div>

            {{-- BUTTON --}}
            <div class="mb-6">
                <a href="{{ route('pemilik.cafe.create') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold transition">
                    + Ajukan Cafe
                </a>
            </div>

            {{-- CARD TABLE --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50">
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">No</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Nama Cafe</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Alamat</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Status</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Harga Rata-Rata</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Wifi</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Parkiran</th>
                                <th class="py-4 px-4 text-center text-slate-900 font-bold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($cafes as $cafe)
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                    <td class="py-5 px-4 text-slate-700">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="py-5 px-4 font-bold text-slate-900 whitespace-nowrap">
                                        {{ $cafe->nama_cafe }}
                                    </td>

                                    <td class="py-5 px-4 text-slate-700">
                                        {{ $cafe->alamat }}
                                    </td>

                                    <td class="py-5 px-4">
                                        @if ($cafe->status == 'approved')
                                            <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-bold">
                                                Approved
                                            </span>
                                        @elseif ($cafe->status == 'pending')
                                            <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-bold">
                                                Pending
                                            </span>
                                        @else
                                            <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-bold">
                                                Rejected
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-5 px-4 text-slate-700 whitespace-nowrap">
                                        Rp {{ number_format($cafe->harga_menu, 0, ',', '.') }}
                                    </td>

                                    <td class="py-5 px-4 text-slate-700 whitespace-nowrap">
                                        {{ $cafe->kecepatan_wifi }} Kbps
                                    </td>

                                    <td class="py-5 px-4 text-slate-700 whitespace-nowrap">
                                        {{ $cafe->luas_parkiran }} m²
                                    </td>
                                    <td class="py-5 px-4">
    <div class="flex items-center justify-center gap-3">

        {{-- EDIT --}}
        <a href="{{ route('pemilik.cafe.edit', $cafe->id_alternatif) }}"
           class="text-blue-500 hover:text-blue-700 text-lg transition">

            <i class="fa-regular fa-pen-to-square"></i>
        </a>

        {{-- DELETE --}}
        <form action="{{ route('pemilik.cafe.destroy', $cafe->id_alternatif) }}"
              method="POST"
              onsubmit="return confirm('Yakin ingin menghapus cafe ini?')">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="text-red-500 hover:text-red-700 text-lg transition">

                <i class="fa-regular fa-trash-can"></i>
            </button>
        </form>

    </div>
</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-10 text-center text-slate-500">
                                        Belum ada data cafe.
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
