<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categories = Category::all();
        return [
            'name' => $this->faker->name(),
            'category_id' => $this->faker->randomElement($categories),
            'valuePerHour' => random_int(10,100) * 10,
            'timePerDay' => $this->faker->time('H:i'),
        ];
    }
}
