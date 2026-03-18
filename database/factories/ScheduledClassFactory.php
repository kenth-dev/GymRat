<?php

namespace Database\Factories;

use App\Models\ClassType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ScheduledClass>
 */
class ScheduledClassFactory extends Factory
{
    public function definition(): array
    {
        return [
            'instructor_id' => User::factory()->create(['role' => 'instructor'])->id,
            'class_type_id' => ClassType::factory()->create()->id,
            'date_time'     => Carbon::now()->addHours(rand(24, 120))->minute(0)->second(0),
        ];
    }
}
