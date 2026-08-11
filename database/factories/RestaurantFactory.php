<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition(): array
    {
        $name = fake()->unique()->company();

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->numberBetween(100, 999),
            'description' => fake()->sentence(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'delivery_fee' => fake()->randomFloat(2, 0, 100),
            'minimum_order_amount' => fake()->randomFloat(2, 0, 500),
            'delivery_time_min' => fake()->numberBetween(20, 30),
            'delivery_time_max' => fake()->numberBetween(35, 60),
            'is_active' => true,
            'is_featured' => fake()->boolean(30),
        ];
    }
}
