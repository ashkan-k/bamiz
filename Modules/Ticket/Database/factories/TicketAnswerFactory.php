<?php

namespace Modules\Ticket\Database\factories;

use App\Enums\EnumHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ticket\Entities\Ticket;
use Modules\User\Entities\User;

class TicketAnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Ticket\Entities\TicketAnswer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => fake()->text(),
            'file' => fake()->filePath(),
            'user_id' => User::factory(),
            'ticket_id' => Ticket::factory(),
        ];
    }
}

