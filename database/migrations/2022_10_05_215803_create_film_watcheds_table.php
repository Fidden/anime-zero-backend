<?php

use App\Models\Film;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('film_watcheds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained();
            $table->foreignIdFor(Film::class)
                ->constrained();
            $table->timestamps();
        });
    }
};
