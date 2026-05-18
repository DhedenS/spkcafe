<x-app-layout>


    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Welcome Card --}}
            <div class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl shadow-lg p-8 mb-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold mt-3">
                            Selamat Datang {{ Auth::user()->name }}
                        </h1>
                        <p class="text-slate-300 mt-3 max-w-2xl">
                            Kelola user, cafe, kriteria, dan lihat hasil perhitungan Weighted Product dengan mudah.
                        </p>
                    </div>

                    <a href="{{ route('admin.cafe') }}"
                       class="bg-white text-slate-900 px-6 py-3 rounded-2xl font-bold shadow hover:bg-slate-100 transition text-center">
                        Cek Data Cafe
                    </a>
                </div>
            </div>

            {{-- Statistik --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Total User</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalUser }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center font-bold">
                            U
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm p-6 border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Cafe Approved</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalCafe }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center font-bold">
                            A
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm p-6 border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Pending Cafe</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $pendingCafe }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-yellow-100 text-yellow-600 flex items-center justify-center font-bold">
                            P
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm p-6 border border-slate-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 font-medium">Total Kriteria</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-2">{{ $totalKriteria }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center font-bold">
                            K
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Cafe Terbaru --}}
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Cafe Terbaru</h3>
                            <p class="text-sm text-slate-500 mt-1">Data cafe yang baru masuk ke sistem</p>
                        </div>

                        <a href="{{ route('admin.cafe') }}"
                           class="text-sm font-bold text-slate-700 hover:text-slate-900">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse ($latestCafe as $cafe)
                                <div class="flex items-center justify-between gap-4 p-4 rounded-2xl bg-slate-50 hover:bg-slate-100 transition">
                                    <div>
                                        <h4 class="font-bold text-slate-900">
                                            {{ $cafe->nama_cafe }}
                                        </h4>
                                        <p class="text-sm text-slate-500 mt-1">
                                            {{ Str::limit($cafe->alamat ?? '-', 60) }}
                                        </p>
                                    </div>

                                    <div>
                                        @if ($cafe->status == 'approved')
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">
                                                Approved
                                            </span>
                                        @elseif ($cafe->status == 'pending')
                                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">
                                                Pending
                                            </span>
                                        @else
                                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-bold">
                                                Rejected
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10 text-slate-500">
                                    Belum ada data cafe.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Menu Cepat --}}
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
                    <h3 class="text-xl font-bold text-slate-900">Menu Cepat</h3>
                    <p class="text-sm text-slate-500 mt-1 mb-6">Akses fitur admin</p>

                    <div class="space-y-3">
                        <a href="{{ route('admin.users') }}"
                           class="flex items-center justify-between p-4 rounded-2xl bg-blue-50 hover:bg-blue-100 transition">
                            <span class="font-bold text-blue-700">Data Pemilik</span>
                            <span class="text-blue-700">→</span>
                        </a>

                        <a href="{{ route('admin.cafe') }}"
                           class="flex items-center justify-between p-4 rounded-2xl bg-green-50 hover:bg-green-100 transition">
                            <span class="font-bold text-green-700">Data Cafe</span>
                            <span class="text-green-700">→</span>
                        </a>

                        <a href="{{ route('admin.kriteria') }}"
                           class="flex items-center justify-between p-4 rounded-2xl bg-yellow-50 hover:bg-yellow-100 transition">
                            <span class="font-bold text-yellow-700">Kelola Kriteria</span>
                            <span class="text-yellow-700">→</span>
                        </a>

                        <a href="{{ route('admin.perhitungan') }}"
                           class="flex items-center justify-between p-4 rounded-2xl bg-purple-50 hover:bg-purple-100 transition">
                            <span class="font-bold text-purple-700">Perhitungan WP</span>
                            <span class="text-purple-700">→</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
