<?php

namespace Database\Factories;

use App\Enums\ProductStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'sku' => 'SKU-' . $this->faker->unique()->numberBetween(100000, 999999),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'stock_quantity' => $this->faker->randomFloat(2, 0, 1000),
            'low_stock_threshold' => $this->faker->numberBetween(5, 50),
            'status' => $this->faker->randomElement([ProductStatus::ACTIVE, ProductStatus::INACTIVE, ProductStatus::DISCONTINUED])
        ];
    }
}
