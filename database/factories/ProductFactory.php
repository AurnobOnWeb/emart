<?php

namespace Database\Factories;

use App\Models\Brands;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'title'=> $this->faker->word(),
            'slug'=> $this->faker->unique()->slug(), 
            'summary'=> $this->faker->text(), 
            'photo'=> $this->faker->imageUrl(height:100, width:100),
            'description'=> $this->faker->paragraph(), 
            'stock'=> $this->faker->numberBetween(2,15), 
            'brand_id'=> $this->faker->randomElement(Brands::pluck('id')->toArray()), 
            'vendor_id'=> $this->faker->randomElement(User::where('role','vendor')->pluck('id')->toArray()), 
            'cat_id'=> $this->faker->randomElement(Category::where('is_parent','1')->pluck('id')->toArray()),
            'child_cat_id'=> $this->faker->randomElement(Category::where('is_parent','1')->pluck('id')->toArray()), 
            'price'=> $this->faker->randomElement([753, 2187, 6192, 8851, 6859, 5726, 9253, 6264, 6874, 9432, 2057, 7942, 7359, 6042, 6891, 8769, 6016, 7861, 5423, 8790] ), 
            'offer_price'=> $this->faker->randomElement([753, 2187, 6192, 8851, 6859, 5726, 9253, 6264, 6874, 9432, 2057, 7942, 7359, 6042, 6891, 8769, 6016, 7861, 5423, 8790] ), 
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'size' => fake()->randomElement(['L','M','S']),
            'status' => fake()->randomElement(['Active','Inactive']),
            'condition' => fake()->randomElement(['new','summar','winter','popular']),
        ];
    }
}
