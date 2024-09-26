<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Stock;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_name' => $this->faker->word(),
            'code' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'unit' => $this->faker->word(),
            'min_quantity' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text(),
            'last_restock_date' => $this->faker->date(),
        ];
    }
}
