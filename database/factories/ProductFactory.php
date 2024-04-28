<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use SebastianBergmann\Type\CallableType;

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
        $category = Category::pluck('id')->toArray();
        return [
            'category_id' => fake()->randomElement($category),
            'title' => fake()->word(),
            'price'=> fake()->numberBetween(4, 1000),
        ];
    }
}
