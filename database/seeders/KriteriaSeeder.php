<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_kriteria')->insert([
            [
                'id_kriteria' => 'C1',
                'nama_kriteria' => 'Suasana',
                'bobot' => 3,
                'tipe' => 'benefit',
            ],
            [
                'id_kriteria' => 'C2',
                'nama_kriteria' => 'Harga',
                'bobot' => 3,
                'tipe' => 'cost',
            ],
            [
                'id_kriteria' => 'C3',
                'nama_kriteria' => 'Jarak',
                'bobot' => 3,
                'tipe' => 'cost',
            ],
            [
                'id_kriteria' => 'C4',
                'nama_kriteria' => 'Parkiran',
                'bobot' => 3,
                'tipe' => 'benefit',
            ],
            [
                'id_kriteria' => 'C5',
                'nama_kriteria' => 'Wifi',
                'bobot' => 3,
                'tipe' => 'benefit',
            ],
        ]);
    }
}
