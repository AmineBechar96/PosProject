<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expence>
 */
class ExpenceFactory extends Factory
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
            'note' => $this->faker->text(),
            'amount' => $this->faker->randomFloat(1000,0,1000.0),
            'attachment' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
            'category_id' => rand(1,20),
            'store_id' => rand(1,20),
            'created_by' => rand(1,20),
        ];
    }
}
