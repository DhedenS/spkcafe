<?php
namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;

class PerhitunganController extends Controller
{
    public function index()
    {
        $data = $this->hitungWP();

        return view('admin.perhitungan.index', [
            'hasil' => $data['hasil'],
        ]);
    }

    public function detail($id)
    {
        $data = $this->hitungWP();

        $detail = collect($data['hasil'])->firstWhere('id_alternatif', $id);

        if (!$detail) {
            abort(404);
        }

        return view('admin.perhitungan.detail', [
            'detail' => $detail,
            'bobotNormal' => $data['bobotNormal'],
            'totalS' => $data['totalS'],
        ]);
    }

    private function hitungWP()
    {
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

            $bobotNormal[$kriteria->id_kriteria] = [
                'nama_kriteria' => $kriteria->nama_kriteria,
                'bobot_asli' => $kriteria->bobot,
                'tipe' => $kriteria->tipe,
                'bobot_normal' => $w,
            ];
        }

        $nilaiS = [];
        $detailNilai = [];

        foreach ($alternatifs as $alternatif) {
            if ($alternatif->penilaian->count() < 5) {
                continue;
            }

            $s = 1;
            $rincian = [];

            foreach ($alternatif->penilaian as $penilaian) {
                $idKriteria = $penilaian->id_kriteria;
                $nilai = $penilaian->nilai;
                $bobot = $bobotNormal[$idKriteria]['bobot_normal'];

                $nilaiPangkat = pow($nilai, $bobot);
                $s *= $nilaiPangkat;

                $rincian[] = [
                    'id_kriteria' => $idKriteria,
                    'nama_kriteria' => $bobotNormal[$idKriteria]['nama_kriteria'],
                    'tipe' => $bobotNormal[$idKriteria]['tipe'],
                    'nilai' => $nilai,
                    'bobot_normal' => $bobot,
                    'nilai_pangkat' => $nilaiPangkat,
                ];
            }

            $nilaiS[$alternatif->id_alternatif] = $s;

            $detailNilai[$alternatif->id_alternatif] = [
                'id_alternatif' => $alternatif->id_alternatif,
                'nama_cafe' => $alternatif->nama_cafe,
                'rincian' => $rincian,
                'nilai_s' => $s,
            ];
        }

        $totalS = array_sum($nilaiS);
        $hasil = [];

        foreach ($nilaiS as $idAlternatif => $s) {
            $nilaiV = $totalS > 0 ? $s / $totalS : 0;

            $hasil[] = [
                'id_alternatif' => $idAlternatif,
                'nama_cafe' => $detailNilai[$idAlternatif]['nama_cafe'],
                'rincian' => $detailNilai[$idAlternatif]['rincian'],
                'nilai_s' => $s,
                'nilai_v' => $nilaiV,
            ];
        }

        usort($hasil, fn ($a, $b) => $b['nilai_v'] <=> $a['nilai_v']);

        foreach ($hasil as $index => &$row) {
            $row['ranking'] = $index + 1;
        }

        return [
            'hasil' => $hasil,
            'bobotNormal' => $bobotNormal,
            'totalS' => $totalS,
        ];
    }
}