<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsultationHour>
 */
class ConsultationHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day' => $this->faker->dayOfWeek,
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
