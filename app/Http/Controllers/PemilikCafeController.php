<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\MenuCafe;
use Illuminate\Http\Request;

class PemilikCafeController extends Controller
{
    public function index()
    {
        $cafes = Alternatif::where('user_id', auth()->id())->get();
        return view('pemilik.cafe.index', compact('cafes'));
    }

    public function create()
    {
        return view('pemilik.cafe.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_cafe' => 'required',
            'nama_pemilik' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'menu' => 'required|array|min:1',
            'menu.*.nama_menu' => 'required|string',
            'menu.*.harga' => 'required|integer|min:1',

            'luas_parkiran' => 'required|integer',
            'kecepatan_wifi' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'jarak' => 'required|numeric',
            'suasana' => 'required|integer|min:1|max:5',
        ]);

        $last = Alternatif::orderBy('id_alternatif', 'desc')->first();
        $number = $last ? intval(substr($last->id_alternatif, 1)) + 1 : 1;
        $idAlternatif = 'A' . $number;

        $fotoCafe = null;
        if ($request->hasFile('foto')) {
            $fotoCafe = $request->file('foto')->store('cafe', 'public');
        }

        $totalHarga = 0;
        $jumlahMenu = count($request->menu);

        foreach ($request->menu as $menu) {
            $totalHarga += $menu['harga'];
        }

        $hargaRataRata = round($totalHarga / $jumlahMenu);

        Alternatif::create([
            'id_alternatif' => $idAlternatif,
            'user_id' => auth()->id(),
            'nama_cafe' => $request->nama_cafe,
            'nama_pemilik' => $request->nama_pemilik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'foto' => $fotoCafe,
            'harga_menu' => $hargaRataRata,
            'luas_parkiran' => $request->luas_parkiran,
            'kecepatan_wifi' => $request->kecepatan_wifi,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'jarak' => $request->jarak,
            'suasana' => $request->suasana,
            'status' => 'pending',
        ]);

        foreach ($request->menu as $menu) {
            MenuCafe::create([
                'id_alternatif' => $idAlternatif,
                'nama_menu' => $menu['nama_menu'],
                'harga' => $menu['harga'],
            ]);
        }

        return redirect()->route('pemilik.cafe')
            ->with('success', 'Cafe berhasil diajukan. Menunggu persetujuan admin.');
    }

    public function edit($id)
    {
        $cafe = Alternatif::with('menu')
            ->where('user_id', auth()->id())
            ->where('id_alternatif', $id)
            ->firstOrFail();

        return view('pemilik.cafe.edit', compact('cafe'));
    }

    public function update(Request $request, $id)
    {
        $cafe = Alternatif::where('user_id', auth()->id())
            ->where('id_alternatif', $id)
            ->firstOrFail();

        $request->validate([
            'nama_cafe' => 'required',
            'nama_pemilik' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'menu' => 'required|array|min:1',
            'menu.*.nama_menu' => 'required|string',
            'menu.*.harga' => 'required|integer|min:1',

            'luas_parkiran' => 'required|integer',
            'kecepatan_wifi' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'jarak' => 'required|numeric',
            'suasana' => 'required|integer|min:1|max:5',
        ]);

        $fotoCafe = $cafe->foto;

        if ($request->hasFile('foto')) {
            $fotoCafe = $request->file('foto')->store('cafe', 'public');
        }

        $totalHarga = 0;
        $jumlahMenu = count($request->menu);

        foreach ($request->menu as $menu) {
            $totalHarga += $menu['harga'];
        }

        $hargaRataRata = round($totalHarga / $jumlahMenu);

        $cafe->update([
            'nama_cafe' => $request->nama_cafe,
            'nama_pemilik' => $request->nama_pemilik,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'foto' => $fotoCafe,
            'harga_menu' => $hargaRataRata,
            'luas_parkiran' => $request->luas_parkiran,
            'kecepatan_wifi' => $request->kecepatan_wifi,
            'jarak' => $request->jarak,
            'suasana' => $request->suasana,
            'status' => 'pending',
        ]);

        MenuCafe::where('id_alternatif', $cafe->id_alternatif)->delete();

        foreach ($request->menu as $menu) {
            MenuCafe::create([
                'id_alternatif' => $cafe->id_alternatif,
                'nama_menu' => $menu['nama_menu'],
                'harga' => $menu['harga'],
            ]);
        }

        return redirect()->route('pemilik.cafe')
            ->with('success', 'Data cafe berhasil diperbarui dan menunggu persetujuan admin.');
    }

    public function destroy($id)
    {
        $cafe = Alternatif::where('user_id', auth()->id())
            ->where('id_alternatif', $id)
            ->firstOrFail();

        MenuCafe::where('id_alternatif', $cafe->id_alternatif)->delete();

        $cafe->delete();

        return redirect()->route('pemilik.cafe')
            ->with('success', 'Cafe berhasil dihapus.');
    }
}