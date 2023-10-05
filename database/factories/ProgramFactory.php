<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'program_code' => 'BS'.$this->faker->unique()->text(4),
            'program_name' => $this->faker->unique()->text(120),
            'program_type' => $this->faker->randomElement(['UNDERGRADUATE', 'GRADUATE']),
            'active_status' => $this->faker->boolean(),
            'num_years' => $this->faker->randomNumber(1),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
