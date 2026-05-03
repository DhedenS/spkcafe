<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCafe extends Model
{
    protected $table = 'tbl_menu_cafe';

    protected $fillable = [
        'id_alternatif',
        'nama_menu',
        'harga',
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id_alternatif');
    }
}