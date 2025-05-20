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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('expense_name')->nullable();
            $table->string('expense_type')->nullable();
            $table->string('date_time')->nullable();
            $table->string('amount')->nullable();
            $table->string('attachment_name')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->unique()->nullable();  // Add a slug column
            $table->text('expense_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
