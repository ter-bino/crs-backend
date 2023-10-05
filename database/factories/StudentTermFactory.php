<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentTerm>
 */
class StudentTermFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'academic_year' => $this->faker->year(),
            'term' => $this->faker->randomElement(['1', '2', '3']),
            'year_level' => $this->faker->randomElement(['1', '2', '3', '4', '5']),
            'student_type' => $this->faker->randomElement(["Old", "New", "Returnee", "Transferee", "Shifter"]),
            'registration_code' => $this->faker->randomElement(['Regular', 'Irregular']),
            'scholastic_status' => $this->faker->randomElement(['Status 1', 'Status 2', 'Status 3']),
            'is_graduating' => $this->faker->boolean(),
        ];
    }
}
