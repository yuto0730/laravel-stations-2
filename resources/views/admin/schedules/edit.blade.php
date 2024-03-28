<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>スケジュール編集</title>
</head>
<body>
    <h1>スケジュール編集</h1>
    <<form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">

        @csrf
        @method('PATCH')
        <label for="start_time_date">開始日:</label>
        <input type="date" name="start_time_date" id="start_time_date" value="{{ $schedule->start_time->format('Y-m-d') }}">

        <label for="start_time_time">開始時刻:</label>
        <input type="time" name="start_time_time" id="start_time_time" value="{{ $schedule->start_time->format('H:i') }}">

        <label for="end_time_date">終了日:</label>
        <input type="date" name="end_time_date" id="end_time_date" value="{{ $schedule->end_time->format('Y-m-d') }}">

        <label for="end_time_time">終了時刻:</label>
        <input type="time" name="end_time_time" id="end_time_time" value="{{ $schedule->end_time->format('H:i') }}">

        <button type="submit">更新</button>
    </form>
</body>
</html>
