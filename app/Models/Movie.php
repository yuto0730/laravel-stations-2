<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_url',
        'published_year',
        'is_showing',
        'description',
        'genre_id' // genre_id を追加
    ];

    protected $casts = [
        'is_showing' => 'boolean',
        'published_year' => 'integer'
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'movie_id');
    }
}
