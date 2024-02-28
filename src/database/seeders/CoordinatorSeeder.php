<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coordinators')->insert([
            [
                'name' => 'Nicolau Magalhães',
                'email_atec' => 'extern.Nicolau.Magalhaes@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'José Monteiro',
                'email_atec' => 'extern.Jose.Monteiro@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana Almeida',
                'email_atec' => 'extern.Ana.Almeida@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Norberto Moreira',
                'email_atec' => 'extern.Norberto.Moreira@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rúben Canelas',
                'email_atec' => 'extern.Ruben.Canelas@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Luís Ferreira',
                'email_atec' => 'extern.Luis.Ferreira@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Moisés Leite',
                'email_atec' => 'extern.Moises.Leite@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mário Silva',
                'email_atec' => 'extern.Mario.Silva@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana Oliveira',
                'email_atec' => 'extern.Ana.Oliveira@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'António Carreira',
                'email_atec' => 'extern.Antonio.Carreira@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'José Macedo',
                'email_atec' => 'extern.Jose.Macedo@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manuel Oliveira',
                'email_atec' => 'extern.Manuel.Oliveira@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'António José Carreira',
                'email_atec' => 'extern.Antonio.Jose.Carreira@atec.pt',
                'phone_number' => '220400500',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
