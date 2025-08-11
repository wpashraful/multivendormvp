<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Models\Product;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $name = $this->faker->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'description' => $this->faker->sentence(12),
            'price' => $this->faker->randomFloat(2, 5, 500),
            'stock' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'category_id' => null, // Set to null or assign a valid category if needed
            'image' => $this->faker->imageUrl(400, 400, 'products', true),
        ];
    }
}
