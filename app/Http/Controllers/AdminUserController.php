<?php
namespace App\Http\Controllers;

use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'pemilik')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function approve($id)
{
    $user = \App\Models\User::findOrFail($id);

    $user->update([
        'status' => 'approved',
    ]);

    return redirect()->back()->with('success', 'User berhasil di-approve.');
}

   public function reject($id)
{
    $user = \App\Models\User::findOrFail($id);

    $user->update([
        'status' => 'rejected',
    ]);

    return redirect()->back()->with('success', 'User berhasil di-reject.');
}
}