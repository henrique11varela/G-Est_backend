<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyPerson>
 */
class CompanyPersonFactory extends Factory
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
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'company_id' => $this->faker->numberBetween(1,10),
            'is_tutor' => $this->faker->numberBetween(1,10),
            'is_contact'=> $this->faker->numberBetween(1,10),
        ];
    }
}
