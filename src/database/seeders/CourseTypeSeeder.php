<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('course_types')->insert([
            [
                'name' => 'Aprendizagem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Educação formação adultos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Especialização tecnológica',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
