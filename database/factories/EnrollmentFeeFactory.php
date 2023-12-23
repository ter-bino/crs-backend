<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EnrollmentFee>
 */
class EnrollmentFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_fee_type' => $this->faker->word(),
            'enrollment_fee_name' => $this->faker->word(),
            'cost' => $this->faker->randomFloat(2, 0, 1000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
