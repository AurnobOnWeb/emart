<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brands>
 */
class BrandsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->word(),
            'slug'=> $this->faker->unique()->slug(),
            'photo'=> $this->faker->imageUrl(height:68, width:68),
            'status'=> $this->faker->randomElement(['Active','Inactive']),
        ];
    }
}
