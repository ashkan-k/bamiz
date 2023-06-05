<?php

namespace Modules\Gallery\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Gallery\Entities\Gallery;
use Modules\Place\Entities\Place;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Gallery\Entities\Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => fake()->imageUrl(),
            'place_id' => Place::factory(),
        ];
    }
}

