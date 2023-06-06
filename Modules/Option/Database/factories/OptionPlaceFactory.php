<?php

namespace Modules\Option\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Option\Entities\Option;
use Modules\Place\Entities\Place;

class OptionPlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Option\Entities\OptionPlace::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'place_id' => Place::factory(),
            'option_id' => Option::factory(),
        ];
    }
}

