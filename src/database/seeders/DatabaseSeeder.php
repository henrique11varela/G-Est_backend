<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AreaSeeder::class,
            CourseSeeder::class,
            StudentSeeder::class,
            StudentCollectionSeeder::class,
            CompanySeeder::class,
            CompanyPersonSeeder::class,
            InternshipSeeder::class,

            EndedInternshipSeeder::class,

            ApplicationSeeder::class,
            UserSeeder::class,
        ]);

    }
}
