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
            UserSeeder::class,
            AreaSeeder::class,
            CourseSeeder::class,
            CoordinatorSeeder::class,
            StudentSeeder::class,
            StudentCollectionSeeder::class,
            CompanySeeder::class,
            CompanyAddressSeeder::class,
            //ApplicationSeeder::class,
            CompanyPersonSeeder::class,
            // InternshipSeeder::class,
            // StartedInternshipSeeder::class,
            // EndedInternshipSeeder::class,
        ]);
    }
}
