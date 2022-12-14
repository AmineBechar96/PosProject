<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posale>
 */
class PosaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
        'quantity' => rand(1,40),
        'price' => $this->faker->randomFloat(10000,5000.0,100000.0),
        'status' => rand(0,6),
        'number' => rand(1,20),
        'time' => now(),
        'time_visit' => now(),
        'table_id' => rand(1,20),
        'register_id' => rand(1,20),
        'product_id' => rand(1,20),
    ];
    }
}
