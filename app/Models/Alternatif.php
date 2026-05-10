<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $table = 'tbl_alternatif';
    protected $primaryKey = 'id_alternatif';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_alternatif',
        'user_id',
        'nama_cafe',
        'nama_pemilik',
        'no_hp',
        'alamat',
        'foto',
        'harga_menu',
        'luas_parkiran',
        'kecepatan_wifi',
        'jarak',
        'suasana',
        'status',
        'latitude',
        'longitude',
    ];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_alternatif', 'id_alternatif');
    }

    public function menu()
    {
        return $this->hasMany(MenuCafe::class, 'id_alternatif', 'id_alternatif');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}