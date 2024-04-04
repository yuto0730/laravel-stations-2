<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Sheet;

class ReservationController extends Controller
{
    /**
     * 予約作成画面を表示する
     */
    public function create($movie_id, $schedule_id)
    {
        $schedule = Schedule::findOrFail($schedule_id);
        $sheets = Sheet::all();

        // ここに必要なロジックを追加する
        return view('reservations.create', compact('schedule', 'sheets'));
    }

    /**
     * 予約をデータベースに保存する
     */
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'sheet_id' => 'required|exists:sheets,id',
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $reservation = new Reservation([
            'schedule_id' => $request->schedule_id,
            'sheet_id' => $request->sheet_id,
            'name' => $request->name ?? '', // デフォルト値を空の文字列に設定
            'email' => $request->email,
            'date' => now(), // または他の適切な日付
        ]);

        $reservation->save();

        // 予約完了ページへリダイレクト、または予約完了情報を表示
        return redirect()->route('reservations.complete')->with('success', '予約が完了しました。');
    }


    /**
     * 予約完了画面を表示する
     */
    public function complete()
    {
        return view('reservations.complete');
    }
}
