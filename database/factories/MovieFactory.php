<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class; // モデルの指定

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'image_url' => $this->faker->imageUrl(),
            'published_year' => $this->faker->year(),
            'is_showing' => $this->faker->boolean,
            'description' => $this->faker->paragraph,
            'genre_id' => Genre::inRandomOrder()->first()->id ?? Genre::factory()->create()->id,
        ];
    }
}

