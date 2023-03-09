<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Purchase>
 */
class PurchaseFactory extends Factory
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
            'reference' => $this->faker->word,
            'tax' => rand(1,50),
            'discount' => rand(1,50),
            'total' => $this->faker->randomFloat(10000,5000.0,100000.0),
            'payement' => $this->faker->randomFloat(10000,5000.0,100000.0),
            'description' => $this->faker->sentence(),
            'attachment' => $this->faker->sentence(),
            'status' => $this->faker->boolean(),
            'type' => $this->faker->boolean(),
            'note' => $this->faker->text(),
            'status' => rand(0,2),
            'created_at' => now(),
            'updated_at' => now(),
            'supplier_id' => rand(1,20),
            'warehouse_id' => rand(1,20),
            'store_id' => rand(1,20),
            'created_by' => rand(1,20),
        ];
    }
}
