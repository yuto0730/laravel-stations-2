{{-- 編集フォームのビュー --}}
<form action="{{ route('admin.movies.update', $movie->id) }}" method="POST">
    @csrf
    @method('PATCH')

    {{-- タイトル入力フィールド --}}
    <div>
        <label for="title">タイトル:</label>
        <input type="text" name="title" id="title" value="{{ old('title', $movie->title) }}" required>
    </div>

    {{-- 画像URL入力フィールド --}}
    <div>
        <label for="image_url">画像URL:</label>
        <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $movie->image_url) }}" required>
    </div>

    {{-- 公開年入力フィールド --}}
    <div>
        <label for="published_year">公開年:</label>
        <input type="number" name="published_year" id="published_year" value="{{ old('published_year', $movie->published_year) }}">
    </div>

    {{-- 上映状況チェックボックス --}}
    <div>
        <label for="is_showing">上映中:</label>
        <input type="checkbox" name="is_showing" id="is_showing" {{ old('is_showing', $movie->is_showing) ? 'checked' : '' }} value="1">
    </div>

    {{-- 概要テキストエリア --}}
    <div>
        <label for="description">概要:</label>
        <textarea name="description" id="description">{{ old('description', $movie->description) }}</textarea>
    </div>

    {{-- ジャンル選択ドロップダウン --}}
    <div>
        <label for="genre_id">ジャンル:</label>
        <select name="genre_id" id="genre_id" required>
            @foreach($genres as $genre)
                <option value="{{ $genre->id }}" {{ $genre->id == old('genre_id', $movie->genre_id) ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- 更新ボタン --}}
    <button type="submit">更新</button>
</form>
