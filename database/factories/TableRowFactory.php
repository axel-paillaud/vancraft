<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Table;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TableRowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $states = ['Unused', 'Second-hand', 'To fix'];

        return [
            'table_id' => Table::where('user_id', 1)->inRandomOrder()->first()->id,
            'user_id' => 1,
            'date' => fake()->dateTimeBetween('2019-01-01', '2024-12-31'),
            'name' => fake()->sentence(),
            'state' => $states[array_rand($states)],
            'quantity' => rand(1, 5) * 10,
            'price' => (rand(100, 300000) / 100),
        ];
    }
}
