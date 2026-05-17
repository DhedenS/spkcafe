<x-app-layout>
    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-slate-900 mt-2">
                    Approval Pengajuan Cafe
                </h1>

                <p class="text-slate-500 mt-3">
                    Kelola pengajuan cafe dari pemilik sebelum masuk ke sistem rekomendasi.
                </p>
            </div>

            {{-- CARD TABLE --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Foto</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Cafe</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Pemilik</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Status</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($cafes as $cafe)
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                                    {{-- FOTO --}}
                                    <td class="py-5 px-4">
                                        @if ($cafe->foto_utama)
                                            <img src="{{ asset('storage/' . $cafe->foto_utama) }}"
                                                alt="{{ $cafe->nama_cafe }}"
                                                class="w-24 h-20 object-cover rounded-xl">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}"
                                                alt="Tidak ada foto"
                                                class="w-24 h-20 object-cover rounded-xl">
                                        @endif
                                    </td>

                                    {{-- NAMA CAFE --}}
                                    <td class="py-5 px-4">
                                        <h3 class="font-bold text-slate-900 text-lg">
                                            {{ $cafe->nama_cafe }}
                                        </h3>

                                        <p class="text-sm text-slate-500 mt-1">
                                            {{ $cafe->alamat }}
                                        </p>
                                    </td>

                                    {{-- PEMILIK --}}
                                    <td class="py-5 px-4 font-semibold text-slate-700">
                                        {{ $cafe->nama_pemilik }}
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="py-5 px-4">

                                        @if ($cafe->status == 'pending')
                                            <span
                                                class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-bold">
                                                Pending
                                            </span>

                                        @elseif ($cafe->status == 'approved')
                                            <span
                                                class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-bold">
                                                Approved
                                            </span>

                                        @elseif ($cafe->status == 'rejected')
                                            <span
                                                class="px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-bold">
                                                Rejected
                                            </span>
                                        @endif

                                    </td>

                                    {{-- AKSI --}}
                                    <td class="py-5 px-4">
                                        <div class="flex gap-3 items-center flex-wrap">

                                            {{-- STATUS PENDING --}}
                                            @if ($cafe->status == 'pending')

                                                {{-- APPROVE --}}
                                                <form action="{{ route('admin.cafe.approve', $cafe->id_alternatif) }}"
                                                    method="POST">
                                                    @csrf

                                                    <button
                                                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl font-bold transition">
                                                        Approve
                                                    </button>
                                                </form>

                                                {{-- REJECT --}}
                                                <form action="{{ route('admin.cafe.reject', $cafe->id_alternatif) }}"
                                                    method="POST">
                                                    @csrf

                                                    <button
                                                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl font-bold transition">
                                                        Reject
                                                    </button>
                                                </form>

                                            {{-- STATUS APPROVED --}}
                                            @elseif ($cafe->status == 'approved')

                                                {{-- REJECT --}}
                                                <form action="{{ route('admin.cafe.reject', $cafe->id_alternatif) }}"
                                                    method="POST">
                                                    @csrf

                                                    <button
                                                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl font-bold transition">
                                                        Reject
                                                    </button>
                                                </form>

                                            {{-- STATUS REJECTED --}}
                                            @elseif ($cafe->status == 'rejected')

                                                {{-- APPROVE --}}
                                                <form action="{{ route('admin.cafe.approve', $cafe->id_alternatif) }}"
                                                    method="POST">
                                                    @csrf

                                                    <button
                                                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl font-bold transition">
                                                        Approve
                                                    </button>
                                                </form>

                                            @endif

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.cafe.delete', $cafe->id_alternatif) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus cafe ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="bg-slate-800 hover:bg-black text-white px-5 py-2 rounded-xl font-bold transition">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="py-10 text-center text-slate-500">
                                        Belum ada pengajuan cafe.
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