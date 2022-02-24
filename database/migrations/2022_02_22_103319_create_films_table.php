<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
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
            $table->foreignId('status_id')->constrained('statuses');
            $table->foreignId('content_type_id')->constrained('content_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
    }
};
