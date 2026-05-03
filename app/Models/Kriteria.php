<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'tbl_kriteria';
    protected $primaryKey = 'id_kriteria';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'id_kriteria',
        'nama_kriteria',
        'bobot',
        'tipe',
    ];
}