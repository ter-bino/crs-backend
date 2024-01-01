<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentBalance>
 */
class StudentBalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'terms_of_payment' => $this->faker->randomElement(['CASH', 'Bank Transfer', 'Installment']),
            'assessment_type' => $this->faker->randomElement(['Regular', 'Irregular']),
            'academic_year' => $this->faker->randomElement(['2020-2021', '2021-2022']),
            'term' => $this->faker->randomElement([1, 2, 3]),
            'total_amount' => $this->faker->randomFloat(2, 1000, 10000),
            'paid_amount' => $this->faker->randomFloat(2, 1000, 10000),
            'overall_paid' => $this->faker->randomFloat(2, 1000, 10000),
            'overall_balance' => $this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}
