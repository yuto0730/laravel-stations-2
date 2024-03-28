<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            SheetsTableSeeder::class,
            ScheduleSeeder::class,

        ]);

        Genre::factory(5)->create();

        Movie::factory(10)->create()->each(function ($movie) {
            $genre = Genre::inRandomOrder()->first();
            $movie->genre()->associate($genre);
            $movie->save();
        });
    }
}
