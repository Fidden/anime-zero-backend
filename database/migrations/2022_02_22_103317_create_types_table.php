<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('value');
            $table->timestamps();
        });

        // Base films types
        DB::table('types')->insert([
            ['name' => 'Фильм', 'value' => 'film'],
            ['name' => 'Сериал', 'value' => 'serial']
        ]);
    }
};
