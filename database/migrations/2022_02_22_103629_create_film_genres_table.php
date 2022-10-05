<?php

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('film_genres', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Film::class)
                ->constrained();
            $table->foreignIdFor(Genre::class)
                ->constrained();
            $table->timestamps();
        });
    }
};
