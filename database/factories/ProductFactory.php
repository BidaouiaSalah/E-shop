<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->name();

        return [
            "name" => $name,
            "slug" => Str::slug($name),
            "description" => fake()->paragraph(),
            "price" => fake()->randomFloat(2, 1, 1000),
            "stock" => fake()->randomDigitNotNull(),
            "category_id" => rand(1, 10),
            "brand_id" => rand(1, 10),
            "user_id" => rand(1, 10),
        ];
    }
}
