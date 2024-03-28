<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Movie</title>
</head>
<body>
    <h1>Create Movie</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('admin/movies/store') }}" method="POST">
        @csrf
        <div>
            <label for="title">映画タイトル:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        </div>
        <div>
            <label for="image_url">画像URL:</label>
            <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" required>
        </div>
        <div>
            <label for="published_year">公開年:</label>
            <input type="number" name="published_year" id="published_year" value="{{ old('published_year') }}">
        </div>
        <div>
            <label for="is_showing">上映中:</label>
            <input type="checkbox" name="is_showing" id="is_showing" {{ old('is_showing') ? 'checked' : '' }}>
        </div>
        <div>
            <label for="description">概要:</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>
        <div>
            <label for="genre_name">ジャンル:</label>
            <input type="text" name="genre_name" id="genre_name" required>
        </div>
        <div>
            <button type="submit">登録</button>
        </div>
    </form>
</body>
</html>
