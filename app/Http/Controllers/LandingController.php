<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Hasil;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index()
    {
        $cafes = Alternatif::where('status', 'approved')
            ->latest()
            ->get();

        $rekomendasi = Hasil::join('tbl_alternatif', 'tbl_hasil.id_alternatif', '=', 'tbl_alternatif.id_alternatif')
            ->orderBy('ranking')
            ->limit(5)
            ->get();
        return view('landing.index', compact('cafes', 'rekomendasi'));
    }

    public function detail($id)
    {
        $cafe = Alternatif::with('menu')
            ->where('id_alternatif', $id)
            ->firstOrFail();

        return view('landing.detail', compact('cafe'));
    }

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
            'C2' => $request->harga,
            'C3' => $request->jarak,
            'C4' => $request->parkiran,
            'C5' => $request->wifi,
        ];

        $labelPreferensi = [
            'suasana' => $this->labelSuasana($request->suasana),
            'harga' => $this->labelHarga($request->harga),
            'jarak' => $this->labelJarak($request->jarak),
            'parkiran' => $this->labelParkiran($request->parkiran),
            'wifi' => $this->labelWifi($request->wifi),
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

                if (!isset($preferensi[$idKriteria]) || !isset($bobotNormal[$idKriteria])) {
                    continue;
                }

                $nilaiCafe = $penilaian->nilai;
                $nilaiUser = $preferensi[$idKriteria];

                $selisih = abs($nilaiCafe - $nilaiUser);
                $nilaiKecocokan = max(1, 4 - $selisih);

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
                'foto' => $cafe->foto
                    ? asset('storage/' . $cafe->foto)
                    : 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=900&q=80',
                'harga_menu' => number_format($cafe->harga_menu, 0, ',', '.'),
                'wifi' => $cafe->kecepatan_wifi,
                'parkiran' => $cafe->luas_parkiran,
                'jarak' => $cafe->jarak,
                'nilai_s' => number_format($s, 6),
                'nilai_v' => number_format($totalS > 0 ? $s / $totalS : 0, 6),
            ];
        }

        usort($hasil, fn ($a, $b) => $b['nilai_v'] <=> $a['nilai_v']);

        $topCafe = $hasil[0] ?? null;

        if ($topCafe) {
            DB::table('tbl_history')->insert([
                'suasana' => $labelPreferensi['suasana'],
                'harga' => $labelPreferensi['harga'],
                'jarak' => $labelPreferensi['jarak'],
                'parkiran' => $labelPreferensi['parkiran'],
                'wifi' => $labelPreferensi['wifi'],
                'id_alternatif' => $topCafe['id_alternatif'],
                'hasil_cafe' => $topCafe['nama_cafe'],
                'created_at' => now(),
            ]);
        }

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
            'foto' => $cafe->foto
                ? asset('storage/' . $cafe->foto)
                : 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=900&q=80',
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

    private function labelSuasana($value)
    {
        return match ((int) $value) {
            1 => 'Biasa',
            2 => 'Nyaman',
            3 => 'Sangat Nyaman',
            default => '-',
        };
    }

    private function labelHarga($value)
    {
        return match ((int) $value) {
            3 => 'Murah',
            2 => 'Sedang',
            1 => 'Mahal',
            default => '-',
        };
    }

    private function labelJarak($value)
    {
        return match ((int) $value) {
            3 => 'Dekat',
            2 => 'Sedang',
            1 => 'Jauh',
            default => '-',
        };
    }

    private function labelParkiran($value)
    {
        return match ((int) $value) {
            1 => 'Kecil',
            2 => 'Sedang',
            3 => 'Luas',
            default => '-',
        };
    }

    private function labelWifi($value)
    {
        return match ((int) $value) {
            1 => 'Lambat',
            2 => 'Sedang',
            3 => 'Cepat',
            default => '-',
        };
    }
}
