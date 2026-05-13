<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Hasil;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
        try {
            $request->validate([
                'suasana' => 'required',
                'harga' => 'required',
                'jarak' => 'required',
                'parkiran' => 'required',
                'wifi' => 'required',
            ]);

            $preferensi = [
                'C1' => (float) $request->suasana,
                'C2' => (float) $request->harga,
                'C3' => (float) $request->jarak,
                'C4' => (float) $request->parkiran,
                'C5' => (float) $request->wifi,
            ];

            $kriterias = Kriteria::all();

            if ($kriterias->count() == 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data kriteria masih kosong.'
                ], 500);
            }

            $totalBobot = $kriterias->sum('bobot');

            if ($totalBobot <= 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Total bobot kriteria tidak valid.'
                ], 500);
            }

            $bobotNormal = [];

            foreach ($kriterias as $kriteria) {
                $w = $kriteria->bobot / $totalBobot;

                if ($kriteria->tipe == 'cost') {
                    $w *= -1;
                }

                $bobotNormal[$kriteria->id_kriteria] = $w;
            }

            $alternatifs = Alternatif::with('penilaian')
                ->where('status', 'approved')
                ->get();

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

                    $nilaiCafe = (float) $penilaian->nilai;
                    $nilaiUser = (float) $preferensi[$idKriteria];

                    if ($nilaiCafe <= 0) {
                        $nilaiCafe = 0.01;
                    }

                    if ($nilaiUser <= 0) {
                        $nilaiUser = 1;
                    }

                    $selisih = abs($nilaiCafe - $nilaiUser);
                    $nilaiKecocokan = max(1, 4 - $selisih);

                    $s *= pow($nilaiKecocokan, $bobotNormal[$idKriteria]);
                }

                if (is_finite($s)) {
                    $nilaiS[$alternatif->id_alternatif] = $s;
                    $detailCafe[$alternatif->id_alternatif] = $alternatif;
                }
            }

            $totalS = array_sum($nilaiS);

            if ($totalS <= 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'Belum ada data cafe approved dengan penilaian lengkap.'
                ], 500);
            }

            $hasil = [];

            foreach ($nilaiS as $idAlternatif => $s) {
                $cafe = $detailCafe[$idAlternatif];
                $nilaiV = $s / $totalS;

                $defaultFoto = 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=900&q=80';
                $fotoUrl = $defaultFoto;

                $foto = json_decode($cafe->foto, true);

                if (is_array($foto) && isset($foto[0]) && !empty($foto[0])) {
                    $fotoUrl = asset('storage/' . $foto[0]);
                } elseif (!empty($cafe->foto) && !str_starts_with($cafe->foto, '[')) {
                    $fotoUrl = asset('storage/' . $cafe->foto);
                }

                $hasil[] = [
                    'id_alternatif' => $cafe->id_alternatif,
                    'nama_cafe' => $cafe->nama_cafe,
                    'alamat' => $cafe->alamat,
                    'foto' => $fotoUrl,
                    'harga_menu' => number_format($cafe->harga_menu, 0, ',', '.'),
                    'wifi' => $cafe->kecepatan_wifi,
                    'parkiran' => $cafe->luas_parkiran,
                    'jarak' => $cafe->jarak,
                    'nilai_s' => $s,
                    'nilai_v' => $nilaiV,
                ];
            }

            usort($hasil, fn($a, $b) => $b['nilai_v'] <=> $a['nilai_v']);

            $topHasil = array_slice($hasil, 0, 10);

            try {
                foreach ($topHasil as $index => $item) {

                    foreach ($topHasil as $index => $item) {
                        DB::table('tbl_history')->insert([
                            'id_alternatif' => $item['id_alternatif'],
                            'suasana' => $this->labelSuasana($request->suasana),
                            'harga' => $this->labelHarga($request->harga),
                            'jarak' => $this->labelJarak($request->jarak),
                            'parkiran' => $this->labelParkiran($request->parkiran),
                            'wifi' => $this->labelWifi($request->wifi),
                            'hasil_cafe' => $item['nama_cafe'],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                }
            } catch (\Throwable $e) {
                dd($e->getMessage());
            }

            $responseData = collect($topHasil)->map(function ($item) {
                $item['nilai_s'] = number_format($item['nilai_s'], 6);
                $item['nilai_v'] = number_format($item['nilai_v'], 6);
                return $item;
            })->values();

            return response()->json([
                'status' => true,
                'data' => $responseData,
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    public function cafeDetailAjax($id)
    {
        $cafe = Alternatif::with('menu')
            ->where('status', 'approved')
            ->where('id_alternatif', $id)
            ->firstOrFail();

        $defaultFoto = 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?auto=format&fit=crop&w=900&q=80';

        $fotoGallery = [];
        $foto = json_decode($cafe->foto, true);

        if (is_array($foto) && count($foto) > 0) {
            foreach ($foto as $item) {
                if (!empty($item)) {
                    $fotoGallery[] = asset('storage/' . $item);
                }
            }
        }

        if (count($fotoGallery) === 0) {
            $fotoGallery[] = $defaultFoto;
        }

        return response()->json([
            'id_alternatif' => $cafe->id_alternatif,
            'nama_cafe' => $cafe->nama_cafe,
            'alamat' => $cafe->alamat,
            'foto' => $fotoGallery[0],
            'gallery' => $fotoGallery,
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
