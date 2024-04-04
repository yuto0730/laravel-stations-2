<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>{{ $movie->title }}</title>
</head>
<body>
    <h1>{{ $movie->title }}</h1>
    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }}">
    <p>{{ $movie->description }}</p>
    <p>公開年: {{ $movie->published_year }}</p>

    <h2>上映スケジュール</h2>
    @if($schedules->isEmpty())
        <p>上映予定はありません。</p>
    @else
        <ul>
            @foreach ($schedules as $schedule)
                <li>
                    {{ $schedule->start_time->format('Y-m-d H:i') }} - {{ $schedule->end_time->format('H:i') }}
                    <a href="{{ url("/movies/{$movie->id}/schedules/{$schedule->id}/sheets") }}">座席を予約する</a>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
