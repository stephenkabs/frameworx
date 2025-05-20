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
        Schema::create('clearances', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('director')->nullable();
            $table->string('prepared_by')->nullable();
            $table->string('position')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('garnish_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes(); // Add this line
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clearances');
    }
};
