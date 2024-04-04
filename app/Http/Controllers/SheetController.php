<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet;
use App\Models\Schedule;

class SheetController extends Controller
{
    // schedule_id パラメータを追加して、特定のスケジュールに紐づく座席を表示
    public function index($movie_id, $schedule_id, Request $request)
    {
        $date = $request->query('date'); // クエリパラメータから日付を取得
        $schedule = Schedule::with('sheets')->findOrFail($schedule_id); // スケジュールを取得し、紐づく座席も取得
        $sheets = $schedule->sheets; // スケジュールに紐づく座席情報を取得

        // 座席情報と日付をビューに渡す
        return view('sheets.index', compact('sheets', 'date', 'movie_id', 'schedule_id'));
    }
}
