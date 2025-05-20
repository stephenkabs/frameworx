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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('nrc')->nullable();
            $table->string('nhima_no')->nullable();
            $table->string('napsa_no')->nullable();
            $table->string('email')->unique();
            $table->string('tracking_code')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->bigInteger('branch_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->string('designation')->nullable();
            $table->string('join_date')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('mm_number')->nullable();
            $table->string('mm_name')->nullable();
            $table->string('branch_location')->nullable();
            $table->string('tax_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('workers');
    }
};
