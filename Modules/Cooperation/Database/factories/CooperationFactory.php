<?php

namespace Modules\Cooperation\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CooperationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Cooperation\Entities\Cooperation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->text(),
            'description' => fake()->text(),
            'file' => fake()->filePath(),
        ];
    }
}

