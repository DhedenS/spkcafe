<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    protected $table = 'tbl_penilaian';
    protected $primaryKey = 'id_penilaian';
    public $timestamps = false;

    protected $fillable = [
        'id_alternatif',
        'id_kriteria',
        'nilai',
    ];
}