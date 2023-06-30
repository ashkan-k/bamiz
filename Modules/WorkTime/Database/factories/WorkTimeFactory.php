<?php

namespace Modules\WorkTime\Database\factories;

use App\Enums\EnumHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Place\Entities\Place;

class WorkTimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\WorkTime\Entities\WorkTime::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'place_id' => Place::factory(),
            'week_days' => fake()->randomElements(EnumHelpers::$WorkTimeItemsEnum, 5),
        ];
    }
}

