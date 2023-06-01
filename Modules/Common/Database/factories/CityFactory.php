<?php

namespace Modules\Common\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Common\Entities\Province;

class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Common\Entities\City::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'province_id' => Province::factory(),
        ];
    }
}

