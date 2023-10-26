<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HasilEvaluasiModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_alternatif' => 1,
                'id_kriteria' => 1,
                'value' => 5,
            ],
            [
                'id_alternatif' => 1,
                'id_kriteria' => 2,
                'value' => 4,
            ],
            [
                'id_alternatif' => 1,
                'id_kriteria' => 3,
                'value' => 5,
            ],
            [
                'id_alternatif' => 1,
                'id_kriteria' => 4,
                'value' => 3,
            ],
            [
                'id_alternatif' => 2,
                'id_kriteria' => 1,
                'value' => 5,
            ],
            [
                'id_alternatif' => 2,
                'id_kriteria' => 2,
                'value' => 5,
            ],
            [
                'id_alternatif' => 2,
                'id_kriteria' => 3,
                'value' => 4,
            ],
            [
                'id_alternatif' => 2,
                'id_kriteria' => 4,
                'value' => 2,
            ],
            [
                'id_alternatif' => 3,
                'id_kriteria' => 1,
                'value' => 3,
            ],
            [
                'id_alternatif' => 3,
                'id_kriteria' => 2,
                'value' => 5,
            ],
            [
                'id_alternatif' => 3,
                'id_kriteria' => 3,
                'value' => 4,
            ],
            [
                'id_alternatif' => 3,
                'id_kriteria' => 4,
                'value' => 4,
            ],
            [
                'id_alternatif' => 4,
                'id_kriteria' => 1,
                'value' => 4,
            ],
            [
                'id_alternatif' => 4,
                'id_kriteria' => 2,
                'value' => 4,
            ],
            [
                'id_alternatif' => 4,
                'id_kriteria' => 3,
                'value' => 3,
            ],
            [
                'id_alternatif' => 4,
                'id_kriteria' => 4,
                'value' => 5,
            ],
            [
                'id_alternatif' => 5,
                'id_kriteria' => 1,
                'value' => 4,
            ],
            [
                'id_alternatif' => 5,
                'id_kriteria' => 2,
                'value' => 5,
            ],
            [
                'id_alternatif' => 5,
                'id_kriteria' => 3,
                'value' => 4,
            ],
            [
                'id_alternatif' => 5,
                'id_kriteria' => 4,
                'value' => 4,
            ],
        ];
    
        DB::table('hasil_evaluasi')->insert($data);
    }
}
