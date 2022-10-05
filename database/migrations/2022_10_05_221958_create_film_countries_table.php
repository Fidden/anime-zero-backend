<?php

use App\Models\Country;
use App\Models\Film;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('film_countries', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Film::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Country::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }
};
