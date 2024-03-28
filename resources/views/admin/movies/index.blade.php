<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Movie List</title>
</head>
<body>
    <h1>Admin Movie List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Image</th>
            <th>Published Year</th>
            <th>Status</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        @foreach ($movies as $movie)
            <tr>
                <td>{{ $movie->id }}</td>
                <td>{{ $movie->title }}</td>
                <td><img src="{{ $movie->image_url }}" width="100" alt="Movie Image"></td>
                <td>{{ $movie->published_year }}</td>
                <td>{{ $movie->is_showing ? '上映中' : '上映予定' }}</td>
                <td>{{ $movie->description }}</td>
                <td>
                    <form action="{{ url('/admin/movies/' . $movie->id . '/edit') }}" method="GET" style="display: inline;">
                        <button type="submit">Edit</button>
                    </form>
                    <form action="{{ url('/admin/movies/' . $movie->id . '/destroy') }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>

