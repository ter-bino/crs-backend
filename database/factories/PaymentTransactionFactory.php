<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentTransaction>
 */
class PaymentTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_order' => $this->faker->randomNumber(5),
            'payment_method' => $this->faker->randomElement(['CASH', 'CHECK', 'BANK']),
            'payment_status' => $this->faker->randomElement(['PAID', 'UNPAID']),
            'amount' => $this->faker->randomFloat(2, 0, 10000),
            'excess_amount' => $this->faker->randomFloat(2, 0, 10000),
            'or_number' => $this->faker->randomNumber(5),
            'code' => $this->faker->randomNumber(5),
            'remark' => $this->faker->text(50),
            'time' => $this->faker->dateTime(),
            'date' => $this->faker->date(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
