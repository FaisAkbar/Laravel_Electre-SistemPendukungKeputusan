<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_alternatif' => 1,
                'alternatif' => 'Asus RT-AX88U',
            ],
            [
                'id_alternatif' => 2,
                'alternatif' => 'TP-Link Archer C4000',
            ],
            [
                'id_alternatif' => 3,
                'alternatif' => 'Netgear Orbi RBK50',
            ],
            [
                'id_alternatif' => 4,
                'alternatif' => 'Google Nest Wifi',
            ],
            [
                'id_alternatif' => 5,
                'alternatif' => 'Eero Pro 6',
            ],
        ];
    
        DB::table('alternatif')->insert($data);
    }
}
