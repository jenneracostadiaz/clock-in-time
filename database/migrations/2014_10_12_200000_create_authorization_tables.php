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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique()->index();
            $table->string('label')->nullable();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->unique()->index();
            $table->string('label')->nullable();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignId('permission_id')->primary();
            $table->foreignId('role_id')->primary();
        });

        Schema::create('permission_user', function (Blueprint $table) {
            $table->foreignId('permission_id')->primary();
            $table->foreignId('user_id')->primary();
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('role_id')->primary();
            $table->foreignId('user_id')->primary();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permission_user');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
};
