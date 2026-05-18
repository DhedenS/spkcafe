<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            KriteriaSeeder::class,
        ]);
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'approved',
        ]);

        User::factory()->create([
            'name' => 'gani',
            'password' => Hash::make('gani1234'),
            'role' => 'pemilik',
            'status' => 'approved',
        ]);
         User::factory()->create([
            'name' => 'wahyu',
            'password' => Hash::make('wahyu123'),
            'role' => 'pemilik',
            'status' => 'approved',
        ]);
    }
}
