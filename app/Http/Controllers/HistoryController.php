<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = DB::table('tbl_history')
            ->leftJoin('tbl_alternatif', 'tbl_history.id_alternatif', '=', 'tbl_alternatif.id_alternatif')
            ->select(
                'tbl_history.*',
                'tbl_alternatif.nama_cafe',
                'tbl_alternatif.alamat'
            )
            ->orderBy('tbl_history.created_at', 'desc')
            ->get();

        return view('admin.history.index', compact('histories'));
    }

    public function detail($id)
    {
        $history = DB::table('tbl_history')
            ->leftJoin('tbl_alternatif', 'tbl_history.id_alternatif', '=', 'tbl_alternatif.id_alternatif')
            ->select(
                'tbl_history.*',
                'tbl_alternatif.nama_cafe',
                'tbl_alternatif.alamat'
            )
            ->where('tbl_history.id_history', $id)
            ->first();

        if (!$history) {
            abort(404);
        }

        $detail = [
            [
                'id_kriteria' => 'C1',
                'kriteria' => 'Suasana',
                'pilihan' => $history->suasana,
                'nilai' => $this->nilaiSuasana($history->suasana),
                'tipe' => 'benefit',
            ],
            [
                'id_kriteria' => 'C2',
                'kriteria' => 'Harga',
                'pilihan' => $history->harga,
                'nilai' => $this->nilaiHarga($history->harga),
                'tipe' => 'cost',
            ],
            [
                'id_kriteria' => 'C3',
                'kriteria' => 'Jarak',
                'pilihan' => $history->jarak,
                'nilai' => $this->nilaiJarak($history->jarak),
                'tipe' => 'cost',
            ],
            [
                'id_kriteria' => 'C4',
                'kriteria' => 'Parkiran',
                'pilihan' => $history->parkiran,
                'nilai' => $this->nilaiParkiran($history->parkiran),
                'tipe' => 'benefit',
            ],
            [
                'id_kriteria' => 'C5',
                'kriteria' => 'Wifi',
                'pilihan' => $history->wifi,
                'nilai' => $this->nilaiWifi($history->wifi),
                'tipe' => 'benefit',
            ],
        ];

        $totalBobotUser = collect($detail)->sum('nilai');

        $bobotNormal = [];

        foreach ($detail as $item) {
            $w = $totalBobotUser > 0 ? $item['nilai'] / $totalBobotUser : 0;

            if ($item['tipe'] === 'cost') {
                $w *= -1;
            }

            $bobotNormal[$item['id_kriteria']] = [
                'nama_kriteria' => $item['kriteria'],
                'bobot_awal' => $item['nilai'],
                'tipe' => $item['tipe'],
                'bobot_normal' => $w,
            ];
        }

        $alternatif = Alternatif::with('penilaian')
            ->where('id_alternatif', $history->id_alternatif)
            ->first();

        $perhitunganS = [];
        $nilaiS = 1;

        if ($alternatif) {
            foreach ($alternatif->penilaian as $penilaian) {
                $idKriteria = $penilaian->id_kriteria;

                if (!isset($bobotNormal[$idKriteria])) {
                    continue;
                }

                $nilai = $penilaian->nilai;
                $bobot = $bobotNormal[$idKriteria]['bobot_normal'];
                $nilaiPangkat = pow($nilai, $bobot);

                $nilaiS *= $nilaiPangkat;

                $perhitunganS[] = [
                    'kriteria' => $bobotNormal[$idKriteria]['nama_kriteria'],
                    'tipe' => $bobotNormal[$idKriteria]['tipe'],
                    'nilai' => $nilai,
                    'bobot_normal' => $bobot,
                    'nilai_pangkat' => $nilaiPangkat,
                ];
            }
        }

        $allAlternatifs = Alternatif::with('penilaian')
            ->where('status', 'approved')
            ->get();

        $totalS = 0;

        foreach ($allAlternatifs as $alt) {
            if ($alt->penilaian->count() < 5) {
                continue;
            }

            $s = 1;

            foreach ($alt->penilaian as $penilaian) {
                $idKriteria = $penilaian->id_kriteria;

                if (!isset($bobotNormal[$idKriteria])) {
                    continue;
                }

                $s *= pow($penilaian->nilai, $bobotNormal[$idKriteria]['bobot_normal']);
            }

            $totalS += $s;
        }

        $nilaiV = $totalS > 0 ? $nilaiS / $totalS : 0;

        return view('admin.history.detail', compact(
            'history',
            'detail',
            'bobotNormal',
            'perhitunganS',
            'nilaiS',
            'totalS',
            'nilaiV'
        ));
    }

    private function nilaiSuasana($value)
    {
        return match ($value) {
            'Biasa' => 1,
            'Nyaman' => 2,
            'Sangat Nyaman' => 3,
            default => 0,
        };
    }

    private function nilaiHarga($value)
    {
        return match ($value) {
            'Murah' => 3,
            'Sedang' => 2,
            'Mahal' => 1,
            default => 0,
        };
    }

    private function nilaiJarak($value)
    {
        return match ($value) {
            'Dekat' => 3,
            'Sedang' => 2,
            'Jauh' => 1,
            default => 0,
        };
    }

    private function nilaiParkiran($value)
    {
        return match ($value) {
            'Kecil' => 1,
            'Sedang' => 2,
            'Luas' => 3,
            default => 0,
        };
    }

    private function nilaiWifi($value)
    {
        return match ($value) {
            'Lambat' => 1,
            'Sedang' => 2,
            'Cepat' => 3,
            default => 0,
        };
    }
}
