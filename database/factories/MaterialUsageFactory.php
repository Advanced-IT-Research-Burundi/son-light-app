<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MaterialUsage;
use App\Models\Stock;
use App\Models\Task;
use App\Models\User;

class MaterialUsageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MaterialUsage::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'stock_id' => Stock::factory(),
            'task_id' => Task::factory(),
            'user_id' => User::factory(),
            'quantity_used' => $this->faker->numberBetween(-10000, 10000),
            'usage_date' => $this->faker->date(),
            'description' => $this->faker->text(),
        ];
    }
}
