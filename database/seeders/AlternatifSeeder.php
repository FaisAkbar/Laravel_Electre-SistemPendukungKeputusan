<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Asus RT-AX88U',
            ],
            [
                'nama' => 'TP-Link Archer C4000',
            ],
            [
                'nama' => 'Netgear Orbi RBK50',
            ],
            [
                'nama' => 'Google Nest Wifi',
            ],
            [
                'nama' => 'Eero Pro 6',
            ],
        ];
    
        DB::table('alternatifs')->insert($data);
    }
}
