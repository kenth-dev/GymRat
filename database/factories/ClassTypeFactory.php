<?php

namespace Database\Factories;

use App\Models\ClassType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ClassType>
 */
class ClassTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'minutes'     => $this->faker->randomElement([30, 45, 60]),
        ];
    }
}
