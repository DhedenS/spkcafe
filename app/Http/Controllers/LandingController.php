<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Hasil;
use App\Models\Kriteria;
use Illuminate\Http\Request;

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

public function rekomendasiAjax(Request $request)
{
    $request->validate([
        'suasana' => 'required|integer',
        'harga' => 'required|integer',
        'jarak' => 'required|integer',
        'parkiran' => 'required|integer',
        'wifi' => 'required|integer',
    ]);

    $preferensi = [
        'C1' => $request->suasana,
        'C2' => $request->parkiran,
        'C3' => $request->harga,
        'C4' => $request->wifi,
        'C5' => $request->jarak,
    ];

    $kriterias = Kriteria::all();
    $alternatifs = Alternatif::with('penilaian')
        ->where('status', 'approved')
        ->get();

    $totalBobot = $kriterias->sum('bobot');

    $bobotNormal = [];

    foreach ($kriterias as $kriteria) {
        $w = $kriteria->bobot / $totalBobot;

        if ($kriteria->tipe === 'cost') {
            $w *= -1;
        }

        $bobotNormal[$kriteria->id_kriteria] = $w;
    }

    $nilaiS = [];
    $detailCafe = [];

    foreach ($alternatifs as $alternatif) {
        if ($alternatif->penilaian->count() < 5) {
            continue;
        }

        $s = 1;

        foreach ($alternatif->penilaian as $penilaian) {
            $idKriteria = $penilaian->id_kriteria;

            $nilaiCafe = $penilaian->nilai;
            $nilaiUser = $preferensi[$idKriteria];

            $selisih = abs($nilaiCafe - $nilaiUser);
            $nilaiKecocokan = max(1, 6 - $selisih);

            $s *= pow($nilaiKecocokan, $bobotNormal[$idKriteria]);
        }

        $nilaiS[$alternatif->id_alternatif] = $s;
        $detailCafe[$alternatif->id_alternatif] = $alternatif;
    }

    $totalS = array_sum($nilaiS);

    $hasil = [];

    foreach ($nilaiS as $idAlternatif => $s) {
        $cafe = $detailCafe[$idAlternatif];

        $hasil[] = [
            'id_alternatif' => $cafe->id_alternatif,
            'nama_cafe' => $cafe->nama_cafe,
            'alamat' => $cafe->alamat,
            'foto' => $cafe->foto ? asset('storage/'.$cafe->foto) : 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=900&q=80',
            'harga_menu' => number_format($cafe->harga_menu, 0, ',', '.'),
            'wifi' => $cafe->kecepatan_wifi,
            'parkiran' => $cafe->luas_parkiran,
            'jarak' => $cafe->jarak,
            'nilai_s' => number_format($s, 6),
            'nilai_v' => number_format($totalS > 0 ? $s / $totalS : 0, 6),
        ];
    }

    usort($hasil, fn ($a, $b) => $b['nilai_v'] <=> $a['nilai_v']);

    return response()->json([
        'status' => true,
        'data' => array_slice($hasil, 0, 10),
    ]);
}

public function cafeDetailAjax($id)
{
    $cafe = Alternatif::with('menu')
        ->where('status', 'approved')
        ->where('id_alternatif', $id)
        ->firstOrFail();

    return response()->json([
        'id_alternatif' => $cafe->id_alternatif,
        'nama_cafe' => $cafe->nama_cafe,
        'alamat' => $cafe->alamat,
        'foto' => $cafe->foto ? asset('storage/'.$cafe->foto) : 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=900&q=80',
        'harga_menu' => number_format($cafe->harga_menu, 0, ',', '.'),
        'wifi' => $cafe->kecepatan_wifi,
        'parkiran' => $cafe->luas_parkiran,
        'jarak' => $cafe->jarak,
        'suasana' => $cafe->suasana,
        'menu' => $cafe->menu->map(function ($menu) {
            return [
                'nama_menu' => $menu->nama_menu,
                'harga' => number_format($menu->harga, 0, ',', '.'),
            ];
        }),
    ]);
}
}
