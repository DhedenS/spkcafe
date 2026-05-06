<?php

namespace App\Http\Controllers;

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
}
