<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StartedInternship>
 */
class StartedInternshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'internship_id' => $this->faker->unique->numberBetween(1,4),
            'meal_allowance' => $this->faker->boolean,
            'start_date' => $this->faker->date('Y_m_d'),
            'company_address_id' => $this->faker->numberBetween(1,10),
            'company_person_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
