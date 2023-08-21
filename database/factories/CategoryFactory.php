<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
                  'summary'=> $this->faker->sentences(3, true), 
                  'photo'=> $this->faker->imageUrl(height:200, width:400),
                  'is_parent'=> $this->faker->randomElement([true,false]),
                  'status'=> $this->faker->randomElement(['Active','Inactive']),
                  'parent_id'=> $this->faker->randomElement(Category::where('is_parent','1')->pluck('id')->toArray()), 
        ];
    }
}
