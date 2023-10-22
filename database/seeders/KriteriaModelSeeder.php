<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_kriteria' => 1,
                'kriteria' => 'Kecepatan',
                'bobot' => 5,
            ],
            [
                'id_kriteria' => 2,
                'kriteria' => 'Jangkauan',
                'bobot' => 4,
            ],
            [
                'id_kriteria' => 3,
                'kriteria' => 'Keamanan',
                'bobot' => 3,
            ],
            [
                'id_kriteria' => 4,
                'kriteria' => 'Harga',
                'bobot' => 4,
            ],
        ];
    
        DB::table('kriteria')->insert($data);
    }
}
