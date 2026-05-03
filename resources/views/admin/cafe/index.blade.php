<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Approval Pengajuan Cafe
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow p-6">
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
                                        <img src="{{ asset('storage/'.$cafe->foto) }}" class="w-24 h-16 object-cover rounded">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="py-3">
                                    <b>{{ $cafe->nama_cafe }}</b><br>
                                    <small>{{ $cafe->alamat }}</small>
                                </td>
                                <td class="py-3">{{ $cafe->nama_pemilik }}</td>
                                <td class="py-3">{{ $cafe->status }}</td>
                                <td class="py-3 flex gap-2">
                                    <form action="{{ route('admin.cafe.approve', $cafe->id_alternatif) }}" method="POST">
                                        @csrf
                                        <button class="bg-green-600 text-white px-3 py-2 rounded">Approve</button>
                                    </form>

                                    <form action="{{ route('admin.cafe.reject', $cafe->id_alternatif) }}" method="POST">
                                        @csrf
                                        <button class="bg-red-600 text-white px-3 py-2 rounded">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>