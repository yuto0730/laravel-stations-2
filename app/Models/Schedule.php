<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id', // 大量代入可能なフィールドに movie_id を追加
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // 映画とのリレーションを定義（必要に応じて）
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
