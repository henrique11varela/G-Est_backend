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
                'course_type_id' => 1,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a de Manutenção Industrial (CA)',
                'course_type_id' => 1,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a de Maquinação e Programação CNC (CA)',
                'course_type_id' => 1,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Programador/a de Informática (CA)',
                'course_type_id' => 1,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //EFA
            [
                'name' => 'Técnico/a de Eletrónica - Automação e Comando (EFA)',
                'course_type_id' => 2,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a de Mecatrónica Automóvel (EFA)',
                'course_type_id' => 2,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a Instalador/a de Sistemas Solares Fotovoltaicos (EFA)',
                'course_type_id' => 2,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a de Refrigeração e Climatização (EFA)',
                'course_type_id' => 2,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            //CET
            [
                'name' => 'Técnico/a Especialista em Gestão de Redes e Sistemas Informáticos (CET)',
                'course_type_id' => 3,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a Especialista em Tecnologias e Programação de Sistemas de Informação (CET)',
                'course_type_id' => 3,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a Especialista em Automação Robótica e Controlo Industrial (CET)',
                'course_type_id' => 3,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Técnico/a Especialista em Cibersegurança (CET)',
                'course_type_id' => 3,
                'area_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
