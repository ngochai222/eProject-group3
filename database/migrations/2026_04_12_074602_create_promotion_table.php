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
        Schema::create('promotion', function (Blueprint $table) {
            $table->id('pro_id');
            $table->string('pro_string', 255);
            $table->enum('pro_discount_type', ['Percentage', 'Fixed']);
            $table->decimal('pro_discount_value', 8, 2);
            $table->datetime('pro_start_date');
            $table->datetime('pro_end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion');
    }
};
