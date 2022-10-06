<?php

use App\Models\Type;
use App\Models\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('kinopoisk_id')->nullable()->unique();
            $table->string('worldart_id')->nullable()->unique();
            $table->string('imdb_id')->nullable()->unique();
            $table->string('player_link');
            $table->string('title')->unique();
            $table->string('title_orig')->unique();
            $table->text('description')->nullable();
            $table->year('year')->nullable();
            $table->string('poster');
            $table->float('rating')->default(0);
            $table->integer('minimal_age')->nullable();
            $table->integer('duration')->nullable();
            $table->foreignIdFor(Status::class)
                ->constrained();
            $table->foreignIdFor(Type::class)
                ->constrained();
            $table->timestamps();
        });
    }
};
