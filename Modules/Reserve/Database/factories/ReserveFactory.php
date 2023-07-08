<?php

namespace Modules\Reserve\Database\factories;

use App\Enums\EnumHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Place\Entities\Place;
use Modules\Reserve\Entities\ReserveType;
use Modules\User\Entities\User;

class ReserveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Reserve\Entities\Reserve::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => fake()->date(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'guest_count' => fake()->randomNumber(),
//            'status' => fake()->boolean(),
            'user_description' => fake()->realText(),
            'user_id' => User::factory(),
            'place_id' => Place::factory(),
            'reserve_type_id' => ReserveType::factory(),
            'status' => fake()->randomElement(EnumHelpers::$ReserveStatusEnum),
//            'type' => fake()->randomElement(EnumHelpers::$ReserveTypesEnum),
        ];
    }
}

