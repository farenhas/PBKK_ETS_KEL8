<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->words(3, true),
            'quantity' => $this->faker->numberBetween(0, 300),
            'price' => $this->faker->randomFloat(2, 1, 200),
            'supplier_id' => \App\Models\Supplier::factory(),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}