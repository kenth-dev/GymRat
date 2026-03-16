<?php

namespace Database\Factories;

use App\Models\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class ScheduledClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'instructor_id' => rand(14,23),
            'class_type_id' => rand(1,5),
            'date_time' => Carbon::now()->addHour(rand(24,120))->minute(0)->seconds(0),
        ];
    }
}
