<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('areas')->insert([
            [
                'area_code' => 481,
                'name' => 'Ciências Informáticas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_code' => 521,
                'name' => 'Metalurgia e Metalomecânica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_code' => 522,
                'name' => 'Eletrónica e Automação',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_code' => 523,
                'name' => 'Eletricidade e Energia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'area_code' => 525,
                'name' => 'Construção e Reparação de Veículos a Motor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
