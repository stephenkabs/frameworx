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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('country_id');
            $table->string('address');
            $table->string('email');
            $table->string('name');
            $table->string('status');
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
        Schema::dropIfExists('branches');
    }
};
