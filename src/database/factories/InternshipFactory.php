<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Internship>
 */
class InternshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => $this->faker->numberBetween(1,10),
            'company_id' => $this->faker->numberBetween(1,10),
            'tutor_id' => $this->faker->numberBetween(1,10),
            'meal_allowance' => $this->faker->numberBetween(0,1),
            'start_date' => $this->faker->date('Y_m_d'),
            'address' => $this->faker->address,
            'observations' => $this->faker->randomLetter,
            'postcode' => $this->faker->postcode,
        ];
    }
}
