<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin.movies.index', compact('movies'));
    }

    public function create()
    {
        $genres = Genre::all();
        return view('admin.movies.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:movies',
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'is_showing' => 'required|boolean',
            'description' => 'required',
            'genre' => 'required|string', // 'genre_name' から 'genre' へ修正
        ]);

        DB::transaction(function () use ($validatedData) {
            $genre = Genre::firstOrCreate(['name' => $validatedData['genre']]);
            $movie = new Movie([
                'title' => $validatedData['title'],
                'image_url' => $validatedData['image_url'],
                'published_year' => $validatedData['published_year'],
                'is_showing' => $validatedData['is_showing'],
                'description' => $validatedData['description'],
            ]);
            $movie->genre()->associate($genre);
            $movie->save();
        });

        return redirect('admin/movies')->with('success', 'Movie created successfully!');
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.show', compact('movie'));
    }
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all();
        $schedules = $movie->schedules; // 例として映画に関連付けられたスケジュールを取得

        return view('admin.movies.edit', compact('movie', 'genres', 'schedules')); // 'schedules' 変数もビューに渡す
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|unique:movies,title,' . $movie->id,
            'image_url' => 'required|url',
            'published_year' => 'required|integer',
            'is_showing' => 'required|boolean',
            'description' => 'required',
            'genre' => 'required|string', // バリデーションルールを適切なフィールド名に合わせる
        ]);

        DB::transaction(function () use ($validatedData, $movie) {
            $genre = Genre::firstOrCreate(['name' => $validatedData['genre']]);
            $movie->update($validatedData);
            $movie->genre()->associate($genre);
            $movie->save();
        });

        return redirect('admin/movies')->with('success', 'Movie updated successfully!');
    }


    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }

        $movie->delete();
        return redirect('/admin/movies')->with('success', 'Movie deleted successfully');
    }

}

