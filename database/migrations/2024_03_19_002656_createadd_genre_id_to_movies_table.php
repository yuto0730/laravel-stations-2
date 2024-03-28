<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateaddGenreIdToMoviesTable extends Migration
{
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->unsignedBigInteger('genre_id')->nullable(); // genre_id カラムを追加
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropForeign(['genre_id']); // 外部キー制約を削除
            $table->dropColumn('genre_id'); // genre_id カラムを削除
        });
    }
}
