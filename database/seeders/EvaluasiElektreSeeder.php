<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluasiElektreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alternatifs = Alternatif::all('id');
        $kriterias = Kriteria::all('id');
        $data = [
            [
                'alternatif_id' => $alternatifs[0]->id,
                'kriteria_id' => $kriterias[0]->id,
                'value' => 5,
            ],
            [
                'alternatif_id' => $alternatifs[0]->id,
                'kriteria_id' => $kriterias[1]->id,
                'value' => 4,
            ],
            [
                'alternatif_id' => $alternatifs[0]->id,
                'kriteria_id' => $kriterias[2]->id,
                'value' => 5,
            ],
            [
                'alternatif_id' => $alternatifs[0]->id,
                'kriteria_id' => $kriterias[3]->id,
                'value' => 3,
            ],
            [
                'alternatif_id' => $alternatifs[1]->id,
                'kriteria_id' => $kriterias[0]->id,
                'value' => 5,
            ],
            [
                'alternatif_id' => $alternatifs[1]->id,
                'kriteria_id' => $kriterias[1]->id,
                'value' => 5,
            ],
            [
                'alternatif_id' => $alternatifs[1]->id,
                'kriteria_id' => $kriterias[2]->id,
                'value' => 4,
            ],
            [
                'alternatif_id' => $alternatifs[1]->id,
                'kriteria_id' => $kriterias[3]->id,
                'value' => 2,
            ],
            [
                'alternatif_id' => $alternatifs[2]->id,
                'kriteria_id' => $kriterias[0]->id,
                'value' => 3,
            ],
            [
                'alternatif_id' => $alternatifs[2]->id,
                'kriteria_id' => $kriterias[1]->id,
                'value' => 5,
            ],
            [
                'alternatif_id' => $alternatifs[2]->id,
                'kriteria_id' => $kriterias[2]->id,
                'value' => 4,
            ],
            [
                'alternatif_id' => $alternatifs[2]->id,
                'kriteria_id' => $kriterias[3]->id,
                'value' => 4,
            ],
            [
                'alternatif_id' => $alternatifs[3]->id,
                'kriteria_id' => $kriterias[0]->id,
                'value' => 4,
            ],
            [
                'alternatif_id' => $alternatifs[3]->id,
                'kriteria_id' => $kriterias[1]->id,
                'value' => 4,
            ],
            [
                'alternatif_id' => $alternatifs[3]->id,
                'kriteria_id' => $kriterias[2]->id,
                'value' => 3,
            ],
            [
                'alternatif_id' => $alternatifs[3]->id,
                'kriteria_id' => $kriterias[3]->id,
                'value' => 5,
            ],
            [
                'alternatif_id' => $alternatifs[4]->id,
                'kriteria_id' => $kriterias[0]->id,
                'value' => 4,
            ],
            [
                'alternatif_id' => $alternatifs[4]->id,
                'kriteria_id' => $kriterias[1]->id,
                'value' => 5,
            ],
            [
                'alternatif_id' => $alternatifs[4]->id,
                'kriteria_id' => $kriterias[2]->id,
                'value' => 4,
            ],
            [
                'alternatif_id' => $alternatifs[4]->id,
                'kriteria_id' => $kriterias[3]->id,
                'value' => 4,
            ],
        ];
    
        DB::table('evaluasi_elektre')->insert($data);
    }
}
