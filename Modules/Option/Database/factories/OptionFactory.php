<?php

namespace Modules\Option\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Option\Entities\Option::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'amount' => fake()->randomNumber(),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
        ];
    }
}

