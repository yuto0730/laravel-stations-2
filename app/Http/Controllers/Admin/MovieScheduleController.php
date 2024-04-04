<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Schedule;
use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use Illuminate\Http\Request;

class MovieScheduleController extends Controller
{
    public function index(Movie $movie)
    {
        $schedules = $movie->schedules()->get();
        return view('admin.movies.schedules.index', compact('movie', 'schedules'));
    }

    public function create(Movie $movie)
    {
        return view('admin.movies.schedules.create', compact('movie'));
    }

    public function store(CreateScheduleRequest $request, Movie $movie)
    {
        $start_date_time = $request->start_time_date . ' ' . $request->start_time_time;
        $end_date_time = $request->end_time_date . ' ' . $request->end_time_time;

        Schedule::create([
            'movie_id' => $movie->id,
            'start_time' => $start_date_time,
            'end_time' => $end_date_time,
        ]);

        return redirect()->route('admin.movies.show', ['id' => $movie->id]);
    }
        public function edit(Schedule $schedule)
    {
        return view('admin.movies.schedules.edit', compact('schedule'));
    }
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $start_date_time = $request->start_time_date . ' ' . $request->start_time_time;
        $end_date_time = $request->end_time_date . ' ' . $request->end_time_time;

        $schedule->update([
            'start_time' => $start_date_time,
            'end_time' => $end_date_time,
        ]);

        return redirect()->route('admin.movies.show', ['id' => $schedule->movie_id]);
    }

    public function destroy(Schedule $schedule)
    {
        $movieId = $schedule->movie_id;
        $schedule->delete();

        return redirect()->route('admin.movies.schedules.index', ['movie' => $movieId])
                         ->with('success', 'スケジュールが正常に削除されました。');
    }
}
