<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use App\Models\Schedule;

class CreateScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'movie_id' => ['required'],
            'start_time_date' => ['required', 'date_format:Y-m-d', 'before_or_equal:end_time_date'],
            'start_time_time' => ['required', 'date_format:H:i'],
            'end_time_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:start_time_date'],
            'end_time_time' => ['required', 'date_format:H:i'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $startDate = $this->input('start_time_date');
            $startTime = $this->input('start_time_time');
            $endDate = $this->input('end_time_date');
            $endTime = $this->input('end_time_time');

            if (!empty($startDate) && !empty($startTime) && !empty($endDate) && !empty($endTime)) {
                try {
                    $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $startDate . ' ' . $startTime);
                    $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $endDate . ' ' . $endTime);
                } catch (\Exception $e) {
                    $validator->errors()->add('start_time_time', '不正な日時フォーマットです。');
                    return;
                }

                if ($startDateTime->gte($endDateTime)) {
                    $validator->errors()->add('start_time_time', '開始時刻は終了時刻より前でなければなりません。');
                    $validator->errors()->add('end_time_time', '終了時刻は開始時刻より後でなければなりません。');
                }

                $diffInMinutes = $startDateTime->diffInMinutes($endDateTime);
                if ($diffInMinutes < 6) {
                    $validator->errors()->add('start_time_time', '時刻の差は少なくとも6分以上でなければなりません。');
                    $validator->errors()->add('end_time_time', '時刻の差は少なくとも6分以上でなければなりません。');
                }
            } else {
                $validator->errors()->add('start_time_time', '開始時刻は有効な日時でなければなりません。');
                $validator->errors()->add('end_time_time', '終了時刻は有効な日時でなければなりません。');
            }
        });
    }

    public function storeSchedule()
    {
        $startDateTime = $this->input('start_time_date') . ' ' . $this->input('start_time_time');
        $endDateTime = $this->input('end_time_date') . ' ' . $this->input('end_time_time');

        Schedule::create([
            'movie_id' => $this->input('movie_id'),
            'start_time' => $startDateTime,
            'end_time' => $endDateTime,
        ]);
    }
}

