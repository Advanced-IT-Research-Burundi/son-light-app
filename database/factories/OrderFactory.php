<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'user_id' => User::factory(),
            'amount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'order_date' => $this->faker->date(),
            'delivery_date' => $this->faker->date(),
            'status' => $this->faker->word(),
            'description' => $this->faker->text(),
        ];
    }
}
