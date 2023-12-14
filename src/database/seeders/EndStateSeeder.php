<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EndStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('end_states')->insert([
            [
                'name' => 'completo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'desistência',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'expulsão',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'troca',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
