<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hold>
 */
class HoldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => rand(1,20),
            'time' => now(),
            'register_id' => rand(1,20),
            'table_id' => rand(1,20),
            'waiter_id' => rand(1,20),
            'customer_id' => rand(1,20),
        ];
    }
}
