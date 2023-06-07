<?php

namespace Modules\Ticket\Database\factories;

use App\Enums\EnumHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Ticket\Entities\TicketCategory;
use Modules\User\Entities\User;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Ticket\Entities\Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'text' => fake()->text(),
            'file' => fake()->filePath(),
            'user_id' => User::factory(),
            'ticket_category_id' => TicketCategory::factory(),
            'status' => fake()->randomElement(EnumHelpers::$TicketStatusEnum),
        ];
    }
}

