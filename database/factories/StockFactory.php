<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => rand(0,2),
            'quantity' => rand(1,20),
            'price' => rand(1,20),
            'product_id' => rand(1,20),
            'store_id' => rand(1,20),
            'warehouse_id' => rand(1,20),
        ];
    }
}
