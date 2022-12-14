<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Register>
 */
class RegisterFactory extends Factory
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
            'status' => $this->faker->boolean(),
            'cash_total' => $this->faker->randomFloat(1000,0,1000.0),
            'cash_sub' => $this->faker->randomFloat(1000,0,1000.0),
            'cash_inhand' => $this->faker->randomFloat(1000,0,1000.0),
            'cc_total' => $this->faker->randomFloat(1000,0,1000.0),
            'cc_sub' => $this->faker->randomFloat(1000,0,1000.0),
            'cheque_total' => $this->faker->randomFloat(1000,0,1000.0),
            'cheque_sub' => $this->faker->randomFloat(1000,0,1000.0), 
            'note' => $this->faker->sentence(),
            'waiterscih' => $this->faker->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => rand(1,20),
            'store_id' => rand(1,20),
            'closed_by' => rand(1,20),
        ];
    }
}
