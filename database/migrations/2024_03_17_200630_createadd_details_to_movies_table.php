<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateaddDetailsToMoviesTable extends Migration
{
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->integer('published_year')->nullable();
            $table->boolean('is_showing')->default(false);
            $table->text('description')->nullable();
        });
    }

    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->dropColumn(['published_year', 'is_showing', 'description']);
        });
    }}
