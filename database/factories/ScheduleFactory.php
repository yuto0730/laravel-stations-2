<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition()
    {
        return [
            'movie_id' => function () {
                return Movie::factory()->create()->id;
            },
            'start_time' => $this->faker->dateTime(),
            'end_time' => $this->faker->dateTime(),
        ];
    }

    public function fixedSchedule()
    {
        return $this->state([
            'start_time' => '2024-03-28 00:00:00',
            'end_time' => '2024-03-28 02:00:00',
        ]);
    }
}

