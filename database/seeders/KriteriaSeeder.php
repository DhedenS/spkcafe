<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_kriteria')->insert([
            [
                'id_kriteria' => 'C1',
                'nama_kriteria' => 'Suasana',
                'bobot' => 5,
                'tipe' => 'benefit',
            ],
            [
                'id_kriteria' => 'C2',
                'nama_kriteria' => 'Luas Parkiran',
                'bobot' => 2,
                'tipe' => 'benefit',
            ],
            [
                'id_kriteria' => 'C3',
                'nama_kriteria' => 'Harga',
                'bobot' => 4,
                'tipe' => 'cost',
            ],
            [
                'id_kriteria' => 'C4',
                'nama_kriteria' => 'Kecepatan Wifi',
                'bobot' => 4,
                'tipe' => 'benefit',
            ],
            [
                'id_kriteria' => 'C5',
                'nama_kriteria' => 'Jarak',
                'bobot' => 3,
                'tipe' => 'cost',
            ],
        ]);
    }
}