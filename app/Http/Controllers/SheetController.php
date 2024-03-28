<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheet; // Sheet モデルをインポート

class SheetController extends Controller
{
    public function index()
    {
        $sheets = Sheet::all(); // Sheet モデルを使用して全ての座席情報を取得
        return view('sheets.index', compact('sheets')); // 取得したデータをビューに渡す
    }
}
