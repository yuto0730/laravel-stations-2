<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    // ここでテーブル名を定義する（オプション）
    protected $table = 'reservations';

    // 代入可能な属性を定義する
    protected $fillable = [
        'user_id',
        'schedule_id',
        'sheet_id',
        'status',
        // その他の必要なカラムをここに追加
    ];

}
