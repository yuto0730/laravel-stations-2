<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>座席表</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .screen {
            background-color: #ddd;
            text-align: center;
            font-weight: bold;
            column-span: all;
        }
        .seat {
            text-align: center;
            border: 1px solid black;
            width: 100px;
            height: 50px;
            font-size: 1.5em;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>座席表</h1>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="5" class="screen">スクリーン</th>
                </tr>
            </thead>
            <tbody>
                @foreach(['a', 'b', 'c'] as $row)
                <tr>
                    @for($i = 1; $i <= 5; $i++)
                        <td class="seat">
                            <a href="{{ route('reservations.create', [
                                'movie_id' => $movie_id,
                                'schedule_id' => $schedule_id,
                                'date' => $date,
                                'sheet_id' => $row . '-' . $i
                            ]) }}">
                                {{ $row }}-{{ $i }}
                            </a>
                        </td>
                    @endfor
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
