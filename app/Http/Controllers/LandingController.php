<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Hasil;
use App\Models\Kriteria;

class LandingController extends Controller
{
    // ===== LANDING PAGE (HALAMAN UTAMA) =====
    public function index()
    {
        // semua cafe yang sudah di-approve
        $cafes = Alternatif::where('status', 'approved')
            ->latest()
            ->get();

        // rekomendasi dari hasil WP
        $rekomendasi = Hasil::join('tbl_alternatif', 'tbl_hasil.id_alternatif', '=', 'tbl_alternatif.id_alternatif')
            ->orderBy('ranking')
            ->limit(5)
            ->get();

        return view('landing.index', compact('cafes', 'rekomendasi'));
    }

    // ===== DETAIL CAFE (UNTUK LANDING) =====
    public function detail($id)
    {
        $cafe = Alternatif::with('menu')
            ->where('id_alternatif', $id)
            ->firstOrFail();

        return view('landing.detail', compact('cafe'));
    }

    // ===== HALAMAN DATA CAFE (HALAMAN BARU) =====
    public function dataCafe()
    {
        $cafes = Alternatif::where('status', 'approved')
            ->with('menu')
            ->latest()
            ->get();

        $totalCafe = $cafes->count();
        $totalKriteria = Kriteria::count();

        return view('landing.data-cafe', compact(
            'cafes',
            'totalCafe',
            'totalKriteria'
        ));
    }

    // ===== DETAIL CAFE KHUSUS DATA CAFE =====
    public function detailCafe($id)
    {
        $cafe = Alternatif::with('menu')
            ->where('status', 'approved')
            ->where('id_alternatif', $id)
            ->firstOrFail();

        return view('landing.detail-cafe', compact('cafe'));
    }
}