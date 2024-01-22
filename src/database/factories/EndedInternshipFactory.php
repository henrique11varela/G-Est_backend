<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EndedInternship>
 */
class EndedInternshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'internship_id' => $this->faker->unique()->numberBetween(1,10),
            'end_state_id' => $this->faker->unique()->numberBetween(1,2),
            'reason' => $this->faker->randomElement(['Completo', 'Desistência', 'Expulsão', 'Troca']),
            'is_working_there' => $this->faker->numberBetween(0,1),
        ];
    }
}
