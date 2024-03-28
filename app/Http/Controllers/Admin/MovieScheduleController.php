<?php

// MovieScheduleController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\CarbonImmutable;


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

    public function store(Request $request, Movie $movie)
{
    $request->validate([
        'movie_id' => 'required|exists:movies,id',
        'start_time_date' => 'required|date_format:Y-m-d',
        'start_time_time' => 'required|date_format:H:i',
        'end_time_date' => 'required|date_format:Y-m-d|after_or_equal:start_time_date',
        'end_time_time' => 'required|date_format:H:i|after:start_time_time',
    ]);

    $startTime = CarbonImmutable::createFromFormat('Y-m-d H:i', $request->input('start_time_date') . ' ' . $request->input('start_time_time'));
    $endTime = CarbonImmutable::createFromFormat('Y-m-d H:i', $request->input('end_time_date') . ' ' . $request->input('end_time_time'));

    if ($endTime->lte($startTime)) {
        return redirect()->back()->withErrors(['start_time_time' => '開始時刻は終了時刻より前でなければなりません。']);
    }

    if ($endTime->diffInMinutes($startTime) < 5) {
        return redirect()->back()->withErrors(['end_time_time' => '終了時刻は開始時刻から5分以上後でなければなりません。']);
    }

    $movie->schedules()->create([
        'start_time' => $startTime->format('Y-m-d H:i:s'),
        'end_time' => $endTime->format('Y-m-d H:i:s'),
    ]);

    return redirect()->route('admin.movies.schedules.index', ['movie' => $movie->id]);
}

public function update(Request $request, Schedule $schedule)
{
    $request->validate([
        'movie_id' => 'required|exists:movies,id',
        'start_time_date' => 'required|date_format:Y-m-d',
        'start_time_time' => 'required|date_format:H:i',
        'end_time_date' => 'required|date_format:Y-m-d|after_or_equal:start_time_date',
        'end_time_time' => 'required|date_format:H:i|after:start_time_time',
    ]);

    $startDateTime = CarbonImmutable::createFromFormat('Y-m-d H:i', $request->input('start_time_date') . ' ' . $request->input('start_time_time'));
    $endDateTime = CarbonImmutable::createFromFormat('Y-m-d H:i', $request->input('end_time_date') . ' ' . $request->input('end_time_time'));

    if ($endDateTime->lessThanOrEqualTo($startDateTime) || $endDateTime->diffInMinutes($startDateTime) < 5) {
        return redirect()->back()->withErrors([
            'start_time_time' => '開始時刻は終了時刻より前でなければなりません。',
            'end_time_time' => '終了時刻は開始時刻から5分以上後でなければなりません。'
        ]);
    }

    $schedule->update([
        'start_time' => $startDateTime->format('Y-m-d H:i:s'),
        'end_time' => $endDateTime->format('Y-m-d H:i:s'),
    ]);

    return redirect()->route('admin.movies.schedules.index', ['movie' => $schedule->movie_id]);
}

    public function edit($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $movie = $schedule->movie;  // スケジュールに関連付けられた映画を取得
        $genres = Genre::all();  // ジャンルのリストは映画情報の編集に必要かもしれません

        // ビューに必要なデータを渡す
        return view('admin.schedules.edit', compact('schedule', 'movie', 'genres'));
    }

    public function destroy($scheduleId)
{
    $schedule = Schedule::find($scheduleId);

    if (!$schedule) {
        abort(404); // スケジュールが見つからない場合は404エラーを返す
    }

    $movieId = $schedule->movie_id;
    $schedule->delete();

    return redirect()->route('admin.movies.schedules.index', ['movie' => $movieId]);
        }
    }
