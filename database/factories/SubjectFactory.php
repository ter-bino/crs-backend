<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_code' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'subject_title' => $this->faker->sentence(3),
            'subject_type' => $this->faker->randomElement(['Lecture', 'Laboratory', 'Lecture/Laboratory']),
            'units' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'credited_units' => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'active_status' => $this->faker->boolean(90),
        ];
    }
}
