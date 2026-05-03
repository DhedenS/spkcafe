<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Approval Akun Pemilik Cafe
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow p-6">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 text-left">No</th>
                            <th class="py-3 text-left">Nama</th>
                            <th class="py-3 text-left">Status</th>
                            <th class="py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="py-3">{{ $loop->iteration }}</td>
                                <td class="py-3">{{ $user->name }}</td>
                                <td class="py-3">{{ $user->status }}</td>
                                <td class="py-3 flex gap-2">
    <td class="py-3 flex gap-2">
    @if ($user->status !== 'approved')
        <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
            @csrf
            <button type="submit"
                style="background:#16a34a; color:white; padding:8px 14px; border-radius:6px;">
                Approve
            </button>
        </form>
    @endif

   @if ($user->status !== 'rejected')
        <form action="{{ route('admin.users.reject', $user->id) }}" method="POST">
            @csrf
            <button type="submit"
                style="background:#dc2626; color:white; padding:8px 14px; border-radius:6px;">
                Reject
            </button>
        </form>
    @endif
</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>