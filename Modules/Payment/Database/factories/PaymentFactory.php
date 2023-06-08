<?php

namespace Modules\Payment\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Reserve\Entities\Reserve;
use Modules\User\Entities\User;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Payment\Entities\Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => fake()->numerify(),
            'refID' => fake()->text(),
            'authority' => fake()->text(),
            'ip' => fake()->ipv4(),
            'status' => fake()->boolean(),
            'user_id' => User::factory(),
            'reserve_id' => Reserve::factory(),
        ];
    }
}

