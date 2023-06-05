<?php

namespace Modules\Place\Database\factories;

use App\Enums\EnumHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Category\Entities\Category;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\User\Entities\User;

class PlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Place\Entities\Place::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->title(),
            'slug' => fake()->unique(),
            'description' => fake()->text(),
            'cover' => fake()->imageUrl(),
            'is_active' => fake()->boolean(),
            'chairs_people_count' => fake()->randomNumber(),
            'viewCount' => fake()->randomNumber(),
            'user_id' => User::factory(),
            'province_id' => Province::factory(),
            'city_id' => City::factory(),
            'category_id' => Category::factory(),
            'type' => fake()->randomElement(EnumHelpers::$PlaceTypesEnum),
        ];
    }
}

