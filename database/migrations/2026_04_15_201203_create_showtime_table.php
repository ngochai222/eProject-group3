<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('showtime', function (Blueprint $table) {
    $table->id();

    $table->foreignId('movie_id')
          ->constrained()
          ->onDelete('cascade');

    $table->foreignId('room_id')
          ->constrained()
          ->onDelete('cascade');

    $table->dateTime('start_time');

    $table->timestamps();
});
    }
};