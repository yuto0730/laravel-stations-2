<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateaddImageUrlToMoviesTable extends Migration
{   public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->text('image_url')->nullable(); // nullableは画像URLがない場合を考慮
        });
    }

    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn('image_url');
        });
    }
}
