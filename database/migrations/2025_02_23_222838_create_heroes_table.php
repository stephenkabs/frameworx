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
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('button_name')->nullable();
            $table->string('button_link')->nullable();
            $table->longText('about')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('heroes');
    }
};
