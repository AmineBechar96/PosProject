<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PayementIncomeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => now(),
            'paid' => $this->faker->randomFloat(10000,5000.0,100000.0),
            'paid_method' => rand(1,20),
            'waiter_id' => rand(1,20),
            'register_id' => rand(1,20),
            'created_by' => rand(1,20),
            'sale_id' => rand(1,20),
        ];
    }
}
