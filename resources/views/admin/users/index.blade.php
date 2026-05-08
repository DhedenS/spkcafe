<x-app-layout>
    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- HEADER --}}
            <div class="mb-8">
              

                <h1 class="text-4xl font-bold text-slate-900 mt-2">
                    Approval Akun Pemilik Cafe
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
