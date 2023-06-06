<?php

namespace Modules\Article\Database\factories;

use App\Enums\EnumHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Entities\User;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Article\Entities\Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->title(),
            'slug' => fake()->shuffleString(),
            'text' => fake()->text(),
            'image' => fake()->imageUrl(),
            'like_count' => fake()->randomNumber(),
            'view_count' => fake()->randomNumber(),
            'status' => fake()->randomElement(EnumHelpers::$ArticleStatusEnum),
        ];
    }
}

