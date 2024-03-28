<!-- resources/views/sheets/index.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>座席表</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- LaravelのデフォルトCSSを適用 -->
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
            width: 100px; /* セルの幅 */
            height: 50px; /* セルの高さ */
            font-size: 1.5em; /* 文字サイズを大きく */
        }
        table {
            border-collapse: collapse;
            width: 100%; /* テーブルの幅を全体に */
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
                <tr>
                    @for ($i = 1; $i <= 5; $i++)
                        <td class="seat">a-{{ $i }}</td>
                    @endfor
                </tr>
                <tr>
                    @for ($i = 1; $i <= 5; $i++)
                        <td class="seat">b-{{ $i }}</td>
                    @endfor
                </tr>
                <tr>
                    @for ($i = 1; $i <= 5; $i++)
                        <td class="seat">c-{{ $i }}</td>
                    @endfor
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
