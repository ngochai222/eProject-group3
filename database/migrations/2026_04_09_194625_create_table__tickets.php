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
        Schema::create('table__tickets', 
        function (Blueprint $table) {
            $table->id();
            
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('showtime_id');
        $table->unsignedBigInteger('seat_id');
            $table->decimal('price', 10, 2);
            $table->enum('status',['booked','cancelled'])->default('booked');
        $table->string('ticket_code')->unique();
        $table->timestamp('booking_time')->nullable();
        $table->string('payment_method')->nullable();
            $table->timestamps();
        
        $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        $table->foreign('showtime_id')->references('id')->on('showtimes')->cascadeOnDelete();
        $table->foreign('seat_id')->references('id')->on('seats')->cascadeOnDelete();

        $table->unique(['showtime_id', 'seat_id']);
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table__tickets');
    }
};
