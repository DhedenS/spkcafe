<aside class="fixed left-0 top-0 z-50 h-screen w-72 bg-slate-950 text-white border-r border-slate-800">
    <div class="h-full flex flex-col">

        <div class="px-6 py-6 border-b border-slate-800">
            <a href="{{ Auth::user()->role === 'admin' ? route('dashboard') : route('pemilik.cafe') }}"
               class="flex items-center gap-3">
                <img src="{{ asset('assets/logo-five.png') }}" class="w-11 h-11 object-contain" alt="Logo">

                <div>
                    <h1 class="font-bold text-lg">SPK Cafe</h1>
                    <p class="text-xs text-slate-400">
                        {{ Auth::user()->role === 'admin' ? 'Admin Panel' : 'Pemilik Cafe' }}
                    </p>
                </div>
            </a>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">

            @if (Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}"
                    class="block px-4 py-3 rounded-xl font-semibold transition
                    {{ request()->routeIs('dashboard') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.users') }}"
                    class="block px-4 py-3 rounded-xl font-semibold transition
                    {{ request()->routeIs('admin.users') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    Approval User
                </a>

                <a href="{{ route('admin.cafe') }}"
                    class="block px-4 py-3 rounded-xl font-semibold transition
                    {{ request()->routeIs('admin.cafe') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    Approval Cafe
                </a>

                <a href="{{ route('admin.kriteria') }}"
                    class="block px-4 py-3 rounded-xl font-semibold transition
                    {{ request()->routeIs('admin.kriteria') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    Kriteria
                </a>

                <a href="{{ route('admin.perhitungan') }}"
                    class="block px-4 py-3 rounded-xl font-semibold transition
                    {{ request()->routeIs('admin.perhitungan') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    Perhitungan WP
                </a>

                <a href="{{ route('admin.history') }}"
                    class="block px-4 py-3 rounded-xl font-semibold transition
                    {{ request()->routeIs('admin.history') || request()->routeIs('admin.history.*') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    History Hasil
                </a>
            @endif

            @if (Auth::user()->role === 'pemilik')
                <a href="{{ route('pemilik.cafe') }}"
                    class="block px-4 py-3 rounded-xl font-semibold transition
                    {{ request()->routeIs('pemilik.cafe') ? 'bg-white text-slate-950' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    Cafe Saya
                </a>
            @endif

        </nav>

        <div class="px-4 py-5 border-t border-slate-800">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full px-4 py-3 rounded-xl bg-red-600 hover:bg-red-700 font-bold transition">
                    Logout
                </button>
            </form>
        </div>

    </div>
</aside>
