<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $movie->title }} の詳細</title>
</head>
<body>
    <h1>{{ $movie->title }}</h1>
    <img src="{{ $movie->image_url }}" alt="{{ $movie->title }} の画像">
    <p>公開年: {{ $movie->published_year }}</p>
    <p>上映中: {{ $movie->is_showing ? 'はい' : 'いいえ' }}</p>
    <p>概要: {{ $movie->description }}</p>

    <h2>上映予定</h2>
    @if($movie->schedules->isEmpty())
        <p>上映予定はありません。</p>
    @else
        <ul>
            @foreach ($movie->schedules as $schedule)
                <li>{{ $schedule->start_time }} - {{ $schedule->end_time }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('admin.movies.edit', $movie->id) }}">編集</a>
</body>
</html>
