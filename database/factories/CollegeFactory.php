<?php

namespace Database\Factories;

use App\Models\College;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class CollegeFactory extends Factory
{
    protected $model = College::class;

    public function definition()
    {
        return [
            'college_code' => 'C' . $this->faker->unique()->randomNumber(3),
            'college_title' => $this->faker->company,
            'num_terms' => $this->faker->numberBetween(1, 3),
            'active_status' => $this->faker->boolean,
        ];
    }
}

