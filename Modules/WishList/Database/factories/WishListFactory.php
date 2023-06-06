<?php

namespace Modules\WishList\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Food\Entities\Food;
use Modules\Place\Entities\Place;
use Modules\User\Entities\User;

class WishListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\WishList\Entities\WishList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $wish_listable = $this->wish_listable();

        return [
            'user_id' => User::factory(),
            'wish_listable_id' => $wish_listable::factory(),
            'wish_listable_type' => $wish_listable,
        ];
    }

    public function wish_listable()
    {
        return $this->faker->randomElement([
            Place::class,
            Food::class,
        ]);
    }
}

