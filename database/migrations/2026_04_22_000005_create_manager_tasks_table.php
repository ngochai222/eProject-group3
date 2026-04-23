<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manager_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manager_id'); // customer_id of manager
            $table->string('type')->default('task');  // task | schedule | request
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('priority')->default('normal'); // low | normal | high | urgent
            $table->string('status')->default('pending'); // pending | in_progress | done
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manager_tasks');
    }
};
