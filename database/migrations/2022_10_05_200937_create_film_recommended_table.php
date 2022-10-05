<?php

use App\Models\Film;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('film_recommended', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Film::class)
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('poster')->nullable();
            $table->timestamps();
        });
    }
};
