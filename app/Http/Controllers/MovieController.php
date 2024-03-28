<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;
use App\Models\Schedule;


class MovieController extends Controller
{
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        $schedules = $movie->schedules()->orderBy('start_time', 'asc')->get();
        return view('movies.show', compact('movie', 'schedules'));
    }



    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        $genres = Genre::all(); // 仮にジャンルをすべて取得する場合
        return view('admin.movies.edit', compact('movie', 'genres'));
    }

    public function index(Request $request)
    {
        $query = Movie::query();

        // キーワードによる検索
        if ($search = $request->input('keyword')) { // 'search'を'keyword'に変更
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // is_showingによる絞り込み
        if ($request->has('is_showing')) {
            $query->where('is_showing', $request->input('is_showing'));
        }

        $movies = $query->paginate(20);

        return view('movies.index', compact('movies'));
    }
}
