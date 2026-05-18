<x-app-layout>
    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="mb-8">
              

                <h1 class="text-4xl font-bold text-slate-900 mt-2">
                    Data Pemilik
                </h1>

                <p class="text-slate-500 mt-3">
                    Kelola akun pemilik cafe yang mendaftar ke sistem.
                </p>
            </div>

            {{-- CARD TABLE --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">No</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Nama</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Status</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($users as $user)
                                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                    <td class="py-5 px-4 text-slate-700">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="py-5 px-4 font-semibold text-slate-900">
                                        {{ $user->name }}
                                    </td>

                                    <td class="py-5 px-4">
                                        @if ($user->status === 'approved')
                                            <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-bold">
                                                Approved
                                            </span>
                                        @elseif ($user->status === 'rejected')
                                            <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 text-sm font-bold">
                                                Rejected
                                            </span>
                                        @else
                                            <span class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 text-sm font-bold">
                                                Pending
                                            </span>
                                        @endif
                                    </td>

                                    <td class="py-5 px-4">
                                        <div class="flex gap-3">
                                            @if ($user->status !== 'approved')
                                                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-xl font-bold transition">
                                                        Approve
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($user->status !== 'rejected')
                                                <form action="{{ route('admin.users.reject', $user->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-xl font-bold transition">
                                                        Reject
                                                    </button>
                                                </form>
                                            @endif

                                            <div x-data="{ open: false }">
                                                <button type="button" @click="open = true"
                                                    class="bg-slate-800 hover:bg-slate-900 text-white px-5 py-2 rounded-xl font-bold transition">
                                                    Delete
                                                </button>
                                            
                                                <div x-show="open" 
                                                     class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm"
                                                     x-transition:enter="transition ease-out duration-300"
                                                     x-transition:enter-start="opacity-0"
                                                     x-transition:enter-end="opacity-100"
                                                     x-transition:leave="transition ease-in duration-200"
                                                     x-transition:leave-start="opacity-100"
                                                     x-transition:leave-end="opacity-0"
                                                     style="display: none;">
                                                     
                                                    <div class="bg-white rounded-3xl p-8 shadow-xl max-w-sm w-full mx-4"
                                                         @click.outside="open = false"
                                                         x-transition:enter="transition ease-out duration-300"
                                                         x-transition:enter-start="opacity-0 translate-y-4 sm:scale-95"
                                                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                         x-transition:leave="transition ease-in duration-200"
                                                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                                         x-transition:leave-end="opacity-0 translate-y-4 sm:scale-95">
                                                         
                                                        <h3 class="text-xl font-bold text-slate-900 text-center mb-6">
                                                            apakah anda ingin menghapus akun
                                                        </h3>
                                                        
                                                        <div class="flex justify-center gap-4">
                                                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="px-8 py-3 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 transition">
                                                                    Iya
                                                                </button>
                                                            </form>
                                                            <button type="button" @click="open = false" 
                                                                    class="px-8 py-3 rounded-xl font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 transition">
                                                                Tidak
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-10 text-center text-slate-500">
                                        Belum ada data user.
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
