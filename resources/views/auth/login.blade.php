<x-guest-layout>
    <div class="min-h-screen bg-black text-white flex items-center justify-center px-6 relative overflow-hidden">
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_top,#333,transparent_35%),linear-gradient(to_bottom,#050505,#000)]">
        </div>

        <div
            class="relative w-full max-w-md bg-white/10 border border-white/10 rounded-[32px] p-8 shadow-2xl backdrop-blur-xl">
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="flex justify-center mtmb-6">
                        <img src="{{ asset('assets/logo-five.png') }}" alt="SPK Cafe Logo"
                            class="w-24 h-24 object-contain drop-shadow-2xl">
                    </div>
                </div>
                <p class="text-gray-400 mt-2">Masuk untuk melanjutkan</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
                @csrf

                <div>
                    <label class="block mb-2 font-semibold">Username</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full bg-black/50 border border-white/10 rounded-2xl px-4 py-3 text-white focus:ring-2 focus:ring-white">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <label class="block mb-2 font-semibold">Password</label>
                    <input type="password" name="password" required
                        class="w-full bg-black/50 border border-white/10 rounded-2xl px-4 py-3 text-white focus:ring-2 focus:ring-white">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <button class="w-full bg-white text-black font-bold py-3 rounded-2xl hover:bg-gray-200 transition">
                    Login
                </button>

                <p class="text-center text-sm text-gray-400">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-white font-bold">Register</a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>
