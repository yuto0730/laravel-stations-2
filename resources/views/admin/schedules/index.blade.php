<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>スケジュール一覧</title>
</head>
<body>
    <h1>スケジュール一覧</h1>
    <ul>
        @foreach($schedules as $schedule)
        <li>
            <a href="{{ route('admin.schedules.edit', $schedule->id) }}">
                {{ $schedule->movie_id }} - {{ $schedule->start_time }} ~ {{ $schedule->end_time }}
            </a>
        </li>
        @endforeach
    </ul>
</body>
</html>
