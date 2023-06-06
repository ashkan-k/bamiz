<?php

namespace Modules\Food\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Place\Entities\Place;

class FoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Food\Entities\Food::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'slug' => fake()->shuffleString(),
            'description' => fake()->text(),
            'price' => fake()->numerify(),
            'image' => fake()->imageUrl(),
            'place_id' => Place::factory(),
        ];
    }
}

