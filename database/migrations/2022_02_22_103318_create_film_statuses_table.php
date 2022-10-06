<?php

use App\Models\Film;
use App\Models\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('film_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Film::class);
            $table->foreignIdFor(Status::class);
            $table->timestamps();
        });
    }
};
