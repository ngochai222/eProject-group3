<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->date('customer_date_of_birth')->nullable()->default(null)->change();
            $table->enum('customer_gender', ['Male','Female','Other'])->nullable()->default('Other')->change();
            $table->string('customer_avatar')->nullable()->default('')->change();
            $table->text('customer_favorite')->nullable()->default('')->change();
            $table->string('customer_address')->nullable()->default('')->change();
        });
    }

    public function down(): void {}
};
