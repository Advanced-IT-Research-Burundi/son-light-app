<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Stock;
use App\Models\StockMovement;
use App\Models\User;

class StockMovementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockMovement::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'stock_id' => Stock::factory(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'type' => $this->faker->word(),
            'reason' => $this->faker->word(),
            'user_id' => User::factory(),
        ];
    }
}
