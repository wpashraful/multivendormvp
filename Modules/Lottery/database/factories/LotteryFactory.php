<?php

namespace Modules\Lottery\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LotteryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Lottery\Models\Lottery::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_id' => \Modules\Product\Models\Product::factory(),
            'user_id' => \App\Models\User::factory(),
            'coupon_code' => strtoupper($this->faker->bothify('????####')),
            'is_used' => $this->faker->boolean(30), // 30% chance of being used
            'used_at' => function (array $attributes) {
                return $attributes['is_used'] ? $this->faker->dateTimeThisYear() : null;
            },
        ];
    }
}

