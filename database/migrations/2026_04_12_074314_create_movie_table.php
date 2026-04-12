<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movie', function (Blueprint $table) {
            $table->id('movie_id');
            $table->string('movie_title', 255);
            $table->text('movie_description');
            $table->date('movie_release_date');
            $table->integer('movie_duration');
            $table->text('movie_trailer');
            $table->string('movie_poster');
            $table->text('movie_cast');
            $table->string('movie_genre', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie');
    }
};
