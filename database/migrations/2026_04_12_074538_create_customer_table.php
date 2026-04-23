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
        Schema::create('customer', function (Blueprint $table) {
            $table->id('customer_id');
            $table->string('customer_name', 255);
            $table->string('customer_email', 100)->unique();
            $table->string('customer_phone', 20)->unique();
            $table->string('customer_password', 255);
            $table->date('customer_date_of_birth');
            $table->enum('customer_gender', ['Male', 'Female', 'Other']);
            $table->string('customer_avatar', 255);
            $table->text('customer_favorite');
            $table->string('customer_address', 255);
            $table->string('role')->default('customer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
