<?php

use App\Models\Director;
use App\Models\Film;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('film_directors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Film::class)
                ->constrained();
            $table->foreignIdFor(Director::class)
                ->constrained();
            $table->timestamps();
        });
    }
};
