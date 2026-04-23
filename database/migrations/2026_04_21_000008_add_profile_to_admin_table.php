<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admin', function (Blueprint $table) {
            if (!Schema::hasColumn('admin', 'name'))     $table->string('name')->default('Admin');
            if (!Schema::hasColumn('admin', 'email'))    $table->string('email')->default('admin@gmail.com');
            if (!Schema::hasColumn('admin', 'phone'))    $table->string('phone')->nullable();
            if (!Schema::hasColumn('admin', 'avatar'))   $table->string('avatar')->nullable();
            if (!Schema::hasColumn('admin', 'password')) $table->string('password')->default(bcrypt('123456'));
        });
    }

    public function down(): void {}
};
