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
            'start_time' => now(),
            'end_time' => now()->addHours(2),
        ];
    }

    public function fixedSchedule()
    {
        return $this->state([
            'start_time' => '2024-03-28 00:00:00',
            'end_time' => '2024-03-28 02:00:00',
        ]);
    }

    public function startTimeAfterEndTime()
    {
        return $this->state([
            'start_time' => '2022-12-31 14:00:00',
            'end_time' => '2022-12-30 15:40:00',
        ]);
    }

    public function shortDuration()
    {
        return $this->state([
            'start_time' => '2022-12-30 14:00:00',
            'end_time' => '2022-12-30 14:05:00',
        ]);
    }
}
