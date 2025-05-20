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
        Schema::create('users', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('agent_tpin')->nullable();
            $table->string('currency', 3)->default('USD'); // Default to USD
            $table->bigInteger('department_id')->nullable();
            $table->boolean('active')->default(true);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('status')->default(true); // Renamed to 'status'
            $table->string('lock_password')->nullable(); // 4-digit password field
            $table->string('password');
            $table->bigInteger('pricing_id')->nullable();
            $table->boolean('is_paid')->default(false); // Default to not paid
            $table->string('image')->nullable();
            $table->string('wallpaper')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->string('special_code')->unique()->nullable();
            $table->string('slug')->unique()->nullable();  // Add a slug column
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
