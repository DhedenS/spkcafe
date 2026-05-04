<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Alternatif;
use App\Models\Kriteria;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUser' => User::count(),
            'totalCafe' => Alternatif::where('status', 'approved')->count(),
            'pendingCafe' => Alternatif::where('status', 'pending')->count(),
            'totalKriteria' => Kriteria::count(),
            'latestCafe' => Alternatif::latest()->limit(5)->get(),
        ]);
    }
}