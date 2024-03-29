<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
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
        $this->validateSchedule($request);

        $startTime = $this->getDateTimeFromRequest($request, 'start_time_date', 'start_time_time');
        $endTime = $this->getDateTimeFromRequest($request, 'end_time_date', 'end_time_time');

        // 日付と時刻のバリデーション
        $errors = [];
        if ($startTime->gt($endTime)) {
            $errors['start_time_date'] = '開始日付は終了日付より前でなければなりません。';
            $errors['end_time_date'] = '終了日付は開始日付より後でなければなりません。';
            $errors['start_time_time'] = '開始時刻は終了時刻より前でなければなりません。';
            $errors['end_time_time'] = '終了時刻は開始時刻よりも後でなければなりません。';
        }

        if ($endTime->diffInMinutes($startTime) < 5) {
            $errors['start_time_time'] = '開始時刻と終了時刻の差は5分以上必要です。';
            $errors['end_time_time'] = '終了時刻は開始時刻から5分以上後でなければなりません。';
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        $movie->schedules()->create([
            'start_time' => $startTime->format('Y-m-d H:i:s'),
            'end_time' => $endTime->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('admin.movies.schedules.index', ['movie' => $movie->id]);
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        $this->validateSchedule($request);

        $startTime = $this->getDateTimeFromRequest($request, 'start_time_date', 'start_time_time');
        $endTime = $this->getDateTimeFromRequest($request, 'end_time_date', 'end_time_time');

        // 日付と時刻のバリデーション
        $errors = [];
        if ($startTime->gt($endTime)) {
            $errors['start_time_date'] = '開始日付は終了日付より前でなければなりません。';
            $errors['end_time_date'] = '終了日付は開始日付より後でなければなりません。';
            $errors['start_time_time'] = '開始時刻は終了時刻より前でなければなりません。';
            $errors['end_time_time'] = '終了時刻は開始時刻よりも後でなければなりません。';
        }

        if ($endTime->diffInMinutes($startTime) < 5) {
            $errors['start_time_time'] = '開始時刻と終了時刻の差は5分以上必要です。';
            $errors['end_time_time'] = '終了時刻は開始時刻から5分以上後でなければなりません。';
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        $schedule->update([
            'start_time' => $startTime->format('Y-m-d H:i:s'),
            'end_time' => $endTime->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('admin.movies.schedules.index', ['movie' => $schedule->movie_id]);
    }



    private function validateSchedule(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'start_time_date' => 'required|date_format:Y-m-d',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d',
            'end_time_time' => 'required|date_format:H:i',
        ]);
    }

    private function getDateTimeFromRequest(Request $request, $dateField, $timeField)
    {
        return CarbonImmutable::createFromFormat('Y-m-d H:i', $request->input($dateField) . ' ' . $request->input($timeField));
    }

    // The edit and destroy methods remain unchanged

    // MovieScheduleController.php

public function edit($id)
{
    $schedule = Schedule::findOrFail($id);
    return view('admin.schedules.edit', compact('schedule'));
}

public function destroy($id)
{
    $schedule = Schedule::findOrFail($id);
    $movieId = $schedule->movie_id;
    $schedule->delete();

    return redirect()->route('admin.movies.schedules.index', ['movie' => $movieId]);
}

}
