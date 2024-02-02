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
            //Aprendizagem
            [
                'name' => 'Técnico/a de Soldadura (CA)',
                'type' => 'CA',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a de Manutenção Industrial (CA)',
                'type' => 'CA',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a de Maquinação e Programação CNC (CA)',
                'type' => 'CA',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Programador/a de Informática (CA)',
                'type' => 'CA',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //EFA
            [
                'name' => 'Técnico/a de Eletrónica - Automação e Comando (EFA)',
                'type' => 'EFA',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a de Mecatrónica Automóvel (EFA)',
                'type' => 'EFA',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a Instalador/a de Sistemas Solares Fotovoltaicos (EFA)',
                'type' => 'EFA',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a de Refrigeração e Climatização (EFA)',
                'type' => 'EFA',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //CET
            [
                'name' => 'Técnico/a Especialista em Gestão de Redes e Sistemas Informáticos (CET)',
                'type' => 'CET',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a Especialista em Tecnologias e Programação de Sistemas de Informação (CET)',
                'type' => 'CET',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a Especialista em Automação Robótica e Controlo Industrial (CET)',
                'type' => 'CET',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a Especialista em Cibersegurança (CET)',
                'type' => 'CET',
                'area_id' => 1,
                'hourly_load' => 3500,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
