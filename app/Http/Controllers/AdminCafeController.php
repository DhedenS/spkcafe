<?php
namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Penilaian;

class AdminCafeController extends Controller
{
    public function index()
    {
        $cafes = Alternatif::with('user')->latest()->get();
        return view('admin.cafe.index', compact('cafes'));
    }

    public function approve($id)
    {
        $cafe = Alternatif::findOrFail($id);

        $cafe->update([
            'status' => 'approved',
        ]);

        Penilaian::where('id_alternatif', $id)->delete();

        Penilaian::insert([
            [
                'id_alternatif' => $id,
                'id_kriteria' => 'C1',
                'nilai' => $cafe->suasana,
            ],
            [
                'id_alternatif' => $id,
                'id_kriteria' => 'C2',
                'nilai' => $this->konversiParkiran($cafe->luas_parkiran),
            ],
            [
                'id_alternatif' => $id,
                'id_kriteria' => 'C3',
                'nilai' => $this->konversiHarga($cafe->harga_menu),
            ],
            [
                'id_alternatif' => $id,
                'id_kriteria' => 'C4',
                'nilai' => $this->konversiWifi($cafe->kecepatan_wifi),
            ],
            [
                'id_alternatif' => $id,
                'id_kriteria' => 'C5',
                'nilai' => $this->konversiJarak($cafe->jarak),
            ],
        ]);

        return back()->with('success', 'Cafe berhasil disetujui.');
    }

    public function reject($id)
    {
        Alternatif::findOrFail($id)->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Cafe berhasil ditolak.');
    }

    private function konversiHarga($harga)
    {
        if ($harga <= 20000) return 1;
        if ($harga <= 30000) return 2;
        if ($harga <= 45000) return 3;
        if ($harga <= 50000) return 4;
        return 5;
    }

    private function konversiParkiran($luas)
    {
        if ($luas <= 20) return 1;
        if ($luas <= 80) return 2;
        if ($luas <= 130) return 3;
        if ($luas <= 190) return 4;
        return 5;
    }

    private function konversiWifi($wifi)
    {
        if ($wifi <= 5000) return 1;
        if ($wifi <= 10000) return 2;
        if ($wifi <= 20000) return 3;
        if ($wifi <= 30000) return 4;
        return 5;
    }

    private function konversiJarak($jarak)
    {
        if ($jarak <= 1) return 1;
        if ($jarak <= 2) return 2;
        if ($jarak <= 3) return 3;
        if ($jarak <= 5) return 4;
        return 5;
    }
}