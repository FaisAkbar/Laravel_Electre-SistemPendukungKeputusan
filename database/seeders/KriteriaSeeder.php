<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kriteria' => 'Kecepatan',
                'bobot' => 5,
            ],
            [
                'kriteria' => 'Jangkauan',
                'bobot' => 4,
            ],
            [
                'kriteria' => 'Keamanan',
                'bobot' => 3,
            ],
            [
                'kriteria' => 'Harga',
                'bobot' => 4,
            ],
        ];
    
        DB::table('kriterias')->insert($data);
    }
}
