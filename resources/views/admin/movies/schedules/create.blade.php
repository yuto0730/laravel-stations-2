<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>スケジュールを追加</title>
</head>
<body>
    <h1>スケジュールを追加</h1>
    <form action="{{ route('admin.movies.schedules.store', ['movie' => $movie->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="movie_id" id="movie_id" value="{{ $movie->id }}">
        <label for="start_time">開始時刻:</label>
        <input type="text" name="start_time" id="start_time">
        <label for="end_time">終了時刻:</label>
        <input type="text" name="end_time" id="end_time">
        <button type="submit">追加</button>
    </form>
</body>
</html>
