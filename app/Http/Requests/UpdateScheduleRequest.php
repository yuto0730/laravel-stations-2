<?php

// UpdateScheduleRequest.php

namespace App\Http\Requests;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'movie_id' => 'required',
            'start_time_date' => 'required|date_format:Y-m-d|before_or_equal:end_time_date',
            'start_time_time' => 'required|date_format:H:i',
            'end_time_date' => 'required|date_format:Y-m-d|after_or_equal:start_time_date',
            'end_time_time' => 'required|date_format:H:i'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $startDate = $this->input('start_time_date');
            $startTime = $this->input('start_time_time');
            $endDate = $this->input('end_time_date');
            $endTime = $this->input('end_time_time');

            try {
                $startDateTime = CarbonImmutable::createFromFormat('Y-m-d H:i', $startDate . ' ' . $startTime);
                $endDateTime = CarbonImmutable::createFromFormat('Y-m-d H:i', $endDate . ' ' . $endTime);

                if ($startDateTime->gte($endDateTime)) {
                    $validator->errors()->add('start_time_time', 'The start time must be before the end time.');
                    $validator->errors()->add('end_time_time', 'The end time must be after the start time.');
                    $validator->errors()->add('start_time_date', 'The start time must be before the end time.');
                    $validator->errors()->add('end_time_date', 'The end time must be after the start time.');
                }
            } catch (\Exception $e) {
                $validator->errors()->add('start_time_date', 'Start date and time have an invalid format.');
                $validator->errors()->add('start_time_time', 'Start date and time have an invalid format.');
                $validator->errors()->add('end_time_date', 'End date and time have an invalid format.');
                $validator->errors()->add('end_time_time', 'End date and time have an invalid format.');
            }

            // ここでセッションにエラーが追加されているか確認
            if ($validator->errors()->any()) {
                session()->flash('errors', $validator->errors());
            }
        });
    }
}
