<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pricing', function (Blueprint $table) {
            $table->id();
            $table->decimal('base_price', 8, 2)->default(10.00);
            $table->tinyInteger('day_of_week'); // 0=Sun, 1=Mon ... 6=Sat
            $table->decimal('surcharge_percent', 5, 2)->default(0); // % tăng thêm
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pricing');
    }
};
