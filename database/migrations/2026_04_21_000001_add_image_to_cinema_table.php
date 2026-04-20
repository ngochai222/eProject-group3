<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cinema', function (Blueprint $table) {
            if (!Schema::hasColumn('cinema', 'cinema_image')) {
                $table->string('cinema_image')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('cinema', function (Blueprint $table) {
            $table->dropColumn('cinema_image');
        });
    }
};
