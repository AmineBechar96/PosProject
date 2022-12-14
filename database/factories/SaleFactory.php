<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tax' => rand(1,50),
            'discount' => rand(1,50),
            'sub_total' => $this->faker->randomFloat(10000,5000.0,100000.0),
            'total' => $this->faker->randomFloat(10000,5000.0,100000.0),
            'total_items' => rand(1,50),
            'paid' => $this->faker->randomFloat(10000,5000.0,100000.0),
            'paid_method' => rand(0,2),
            'tax_amount' => $this->faker->randomFloat(10000,5000.0,100000.0),
            'discount_amount' => $this->faker->randomFloat(10000,5000.0,100000.0),
            'first_payement' => $this->faker->randomFloat(10000,5000.0,100000.0),
            'created_at' => now(),
            'updated_at' => now(),
            'register_id' => rand(1,20),
            'created_by' => rand(1,20),
            'client_id' => rand(1,20),
            'waiter_id' => rand(1,20),
        ];
    }
}
