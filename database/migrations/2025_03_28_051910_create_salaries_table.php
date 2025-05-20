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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('worker_id')->nullable();  // Add a slug column;
            $table->foreignId('worker_id')->constrained()->onDelete('cascade');
            $table->string('basic_salary')->nullable();
            $table->string('housing_allowance')->nullable();
            $table->string('transport_allowance')->nullable();
            $table->string('other_allowance')->nullable();
            $table->string('other_allowance_two')->nullable();
            $table->string('payee')->nullable();
            $table->string('daily_earnings')->nullable();
            $table->string('daily_hourly')->nullable();
            $table->string('monthly_working_days')->nullable();
            $table->string('napsa')->nullable();
            $table->string('nhima')->nullable();
            $table->string('net_pay')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique()->nullable();  // Add a slug column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
