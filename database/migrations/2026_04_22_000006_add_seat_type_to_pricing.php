<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pricing', function (Blueprint $table) {
            if (!Schema::hasColumn('pricing', 'seat_type')) {
                $table->string('seat_type')->default('standard')->after('id');
                // standard | imax | gold
            }
        });
    }

    public function down(): void
    {
        Schema::table('pricing', function (Blueprint $table) {
            $table->dropColumn('seat_type');
        });
    }
};
