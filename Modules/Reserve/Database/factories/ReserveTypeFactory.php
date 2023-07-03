<?php

namespace Modules\Reserve\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReserveTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Reserve\Entities\ReserveType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'price' => fake()->randomNumber(),
        ];
    }
}

