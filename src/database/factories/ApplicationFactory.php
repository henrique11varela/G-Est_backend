<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'company_name' => $this->faker->name,
            'activity_sector' => $this->faker->name,
            'locality' => $this->faker->name,
            'website' => $this->faker->name,
            'contact_name' => $this->faker->name,
            'contact_telephone' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->email,
            'number_students'  => $this->faker->numberBetween(1,10),
            'student_profile' => $this->faker->name,
            'student_tasks' => $this->faker->name,
            'company_id' => $this->faker->numberBetween(1,10),
            'is_partner'=> $this->faker->numberBetween(0,1),
            //'is_valid'=> $this->faker->numberBetween(0,1),
        ];
    }
}
