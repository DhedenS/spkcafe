<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Cafe Saya
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div style="background:#d1fae5; padding:12px; margin-bottom:15px;">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('pemilik.cafe.create') }}"
               style="background:#2563eb; color:white; padding:10px 15px; border-radius:6px; display:inline-block; margin-bottom:15px;">
                + Ajukan Cafe
            </a>

            <div style="background:white; padding:20px; border-radius:10px;">
                <table border="1" cellpadding="10" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Cafe</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th>Harga Rata-Rata</th>
                            <th>Wifi</th>
                            <th>Parkiran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cafes as $cafe)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cafe->nama_cafe }}</td>
                                <td>{{ $cafe->alamat }}</td>
                                <td>{{ $cafe->status }}</td>
                                <td>Rp {{ number_format($cafe->harga_menu, 0, ',', '.') }}</td>
                                <td>{{ $cafe->kecepatan_wifi }} Kbps</td>
                                <td>{{ $cafe->luas_parkiran }} m²</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" align="center">
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