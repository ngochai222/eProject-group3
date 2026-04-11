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
        Schema::create('table_seats', 
        function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('room_id');
        $table->string('seat_number');
        $table->string('row');
        $table->integer('column');
            $table->enum('type',['normal',
            'vip','couple'])->default('normal');
            $table->timestamps();
            
        $table->foreign('room_id')->references('id')->on('rooms')->cascadeOnDelete();
            $table->unique(['room_id', 'seat_number']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_seats');
    }
};
