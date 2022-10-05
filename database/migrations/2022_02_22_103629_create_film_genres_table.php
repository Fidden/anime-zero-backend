<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('film_genres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained('films');
            $table->foreignId('genre_id')->constrained('genres');
            $table->timestamps();
        });
    }
};
