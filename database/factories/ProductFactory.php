<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'name' => $this->faker->word,
            'cost' => $this->faker->randomFloat(1000,0,1000.0),
            'tax' => rand(1,50),
            'price' => $this->faker->randomFloat(1000,0,1000.0),
            'description' => $this->faker->text(),
            'photo' => $this->faker->filePath(),
            'photothumb' => $this->faker->filePath(),
            'color' => $this->faker->colorName(),
            'type' => $this->faker->boolean(),
            'alertqt' => rand(1,50),
            'unit' => $this->faker->word(),
            'taxmethod' => rand(1,50),
            'h_stores' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
            'category_id' => rand(1,20),
            'supplier_id' => rand(1,20),
        ];
    }
}

            