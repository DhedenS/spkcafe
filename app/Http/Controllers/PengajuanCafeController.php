<?php
namespace App\Http\Controllers;
use App\Models\Alternatif;
use App\Models\MenuCafe;
use Illuminate\Http\Request;

class PengajuanCafeController extends Controller
{
  public function store(Request $request)
{
    $request->validate([
        'nama_cafe' => 'required',
        'nama_pemilik' => 'required',
        'no_hp' => 'required',
        'alamat' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'nama_menu' => 'required',
        'harga_menu' => 'required|integer',
        'foto_menu' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'luas_parkiran' => 'required|integer',
        'kecepatan_wifi' => 'required|integer',
        'jarak' => 'required|integer',
        'suasana' => 'required|integer|min:1|max:5',
    ]);

    $last = Alternatif::orderBy('id_alternatif', 'desc')->first();
    $number = $last ? intval(substr($last->id_alternatif, 1)) + 1 : 1;
    $idAlternatif = 'A' . $number;

    $fotoCafe = null;
    if ($request->hasFile('foto')) {
        $fotoCafe = $request->file('foto')->store('cafe', 'public');
    }

    $fotoMenu = null;
    if ($request->hasFile('foto_menu')) {
        $fotoMenu = $request->file('foto_menu')->store('menu', 'public');
    }

    Alternatif::create([
        'id_alternatif' => $idAlternatif,
        'nama_cafe' => $request->nama_cafe,
        'nama_pemilik' => $request->nama_pemilik,
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat,
        'foto' => $fotoCafe,
        'harga_menu' => $request->harga_menu,
        'luas_parkiran' => $request->luas_parkiran,
        'kecepatan_wifi' => $request->kecepatan_wifi,
        'jarak' => $request->jarak,
        'suasana' => $request->suasana,
        'status' => 'pending',
    ]);

    MenuCafe::create([
        'id_alternatif' => $idAlternatif,
        'nama_menu' => $request->nama_menu,
        'harga' => $request->harga_menu,
        'foto_menu' => $fotoMenu,
    ]);

    return redirect()->back()->with('success', 'Pengajuan cafe berhasil dikirim.');
}
}
