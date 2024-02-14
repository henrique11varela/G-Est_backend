<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentCollection>
 */
class StudentCollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'course_id' => $this->faker->numberBetween(1,12),
            'coordinator_id' => $this->faker->numberBetween(1,10),
        ];
    }
}
