<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\Admin\MovieScheduleController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ReservationController; // この行を追加

// 一般ユーザー向けのルーティング
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'show']);
Route::get('/sheets', [SheetController::class, 'index']); // 座席情報のルーティング

// 映画関連のルーティング（管理者向け）
Route::get('/admin/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');
Route::get('/admin/movies/create', [AdminMovieController::class, 'create'])->name('admin.movies.create');
Route::post('/admin/movies/store', [AdminMovieController::class, 'store'])->name('admin.movies.store');
Route::get('/admin/movies/{id}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');
Route::patch('/admin/movies/{id}/update', [AdminMovieController::class, 'update'])->name('admin.movies.update');
Route::delete('/admin/movies/{id}/destroy', [AdminMovieController::class, 'destroy'])->name('admin.movies.destroy');
Route::get('/admin/movies/{id}', [AdminMovieController::class, 'show'])->name('admin.movies.show');

// 映画のスケジュールに関するルーティング（管理者向け）
Route::get('/admin/movies/{movie}/schedules', [MovieScheduleController::class, 'index'])->name('admin.movies.schedules.index');
Route::get('/admin/movies/{movie}/schedules/create', [MovieScheduleController::class, 'create'])->name('admin.movies.schedules.create');
Route::post('/admin/movies/{movie}/schedules/store', [MovieScheduleController::class, 'store'])->name('admin.movies.schedules.store');
Route::get('/admin/schedules/{schedule}/edit', [MovieScheduleController::class, 'edit'])->name('admin.movies.schedules.edit');
Route::patch('/admin/schedules/{schedule}/update', [MovieScheduleController::class, 'update'])->name('admin.schedules.update');
Route::delete('/admin/schedules/{schedule}/destroy', [MovieScheduleController::class, 'destroy'])->name('admin.schedules.destroy');

// 予約関連のルーティング
Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets', [SheetController::class, 'index']);
Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create', [ReservationController::class, 'create']);
Route::post('/reservations/store', [ReservationController::class, 'store']);

// 以下のルーティングは重複しているので削除が必要かもしれません
// Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets', 'SheetController@index')->name('sheets.index');
// Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create', 'ReservationController@create')->name('reservations.create');
