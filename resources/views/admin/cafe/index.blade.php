<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Approval Pengajuan Cafe
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow p-6 overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 text-left">Foto</th>
                            <th class="py-3 text-left">Cafe</th>
                            <th class="py-3 text-left">Pemilik</th>
                            <th class="py-3 text-left">Status</th>
                            <th class="py-3 text-left">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cafes as $cafe)
                            <tr class="border-b">
                                <td class="py-3">
                                    @if ($cafe->foto)
                                        <img src="{{ asset('storage/' . $cafe->foto) }}"
                                             class="w-28 h-28 object-contain rounded bg-white border p-1">
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="py-3">
                                    <b>{{ $cafe->nama_cafe }}</b><br>
                                    <small>{{ $cafe->alamat }}</small>
                                </td>

                                <td class="py-3">{{ $cafe->nama_pemilik }}</td>

                                <td class="py-3">
                                    @if ($cafe->status == 'pending')
                                        <span class="text-yellow-600 font-semibold">Pending</span>
                                    @elseif ($cafe->status == 'approved')
                                        <span class="text-green-600 font-semibold">Approved</span>
                                    @elseif ($cafe->status == 'rejected')
                                        <span class="text-red-600 font-semibold">Rejected</span>
                                    @endif
                                </td>

                                <td class="py-3">
                                    <div class="flex gap-2 items-center">
                                        @if ($cafe->status == 'pending')
                                            <form action="{{ route('admin.cafe.approve', $cafe->id_alternatif) }}" method="POST">
                                                @csrf
                                                <button class="bg-green-600 text-white px-3 py-2 rounded">
                                                    Approve
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.cafe.reject', $cafe->id_alternatif) }}" method="POST">
                                                @csrf
                                                <button class="bg-red-600 text-white px-3 py-2 rounded">
                                                    Reject
                                                </button>
                                            </form>
                                        @elseif ($cafe->status == 'approved')
                                            <form action="{{ route('admin.cafe.reject', $cafe->id_alternatif) }}" method="POST">
                                                @csrf
                                                <button class="bg-red-600 text-white px-3 py-2 rounded">
                                                    Reject
                                                </button>
                                            </form>
                                        @elseif ($cafe->status == 'rejected')
                                            <form action="{{ route('admin.cafe.approve', $cafe->id_alternatif) }}" method="POST">
                                                @csrf
                                                <button class="bg-green-600 text-white px-3 py-2 rounded">
                                                    Approve
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
