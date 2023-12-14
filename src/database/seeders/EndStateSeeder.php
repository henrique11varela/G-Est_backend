<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EndStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('end_states')->insert([
            [
                'name' => 'Completo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desistência',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Expulsão',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Troca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
