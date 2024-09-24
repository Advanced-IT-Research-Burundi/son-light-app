<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Order;
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
            'user_id' => User::factory(),
            'type' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'order_id' => Order::factory(),
            'description' => $this->faker->text(),
        ];
    }
}
