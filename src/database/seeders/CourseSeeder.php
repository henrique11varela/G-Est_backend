<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'name' => 'Cibersegurança',
                'type' => 'CET',
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tecnologia Mecatrónica',
                'type' => 'CET',
                'area_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tecnologias e Programação de Sistemas de Informação',
                'type' => 'CET',
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gestão de Redes e Sistemas Informáticos',
                'type' => 'CET',
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Automação Robótica e Controlo Industrial',
                'type' => 'CET',
                'area_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Informática - Instalação e Gestão de Redes',
                'type' => 'APZ',
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mecatrónica Automóvel',
                'type' => 'APZ',
                'area_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mecatrónica Automóvel, Planeamento e Controlo de Processos',
                'type' => 'CET',
                'area_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gestão e Controlo de Energia',
                'type' => 'CET',
                'area_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico de Refrigeração e Climatização',
                'type' => 'EFA',
                'area_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico de Soldadura',
                'type' => 'EFA',
                'area_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico de Mecatrónica Automóvel',
                'type' => 'EFA',
                'area_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
