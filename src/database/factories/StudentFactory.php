<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
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
            'personal_email'=> $this->faker->email,
            'atec_email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->streetAddress,
            'postal_code' => $this->faker->postcode,
            'locality' => $this->faker->city,
            'soft_skills' => $this->faker->randomElement(['Muito Fraco', 'Fraco', 'Razoável', 'Bom', 'Muito Bom']),
            'hard_skills' => $this->faker->randomElement(['Muito Fraco', 'Fraco', 'Razoável', 'Bom', 'Muito Bom']),
        ];
    }
}
