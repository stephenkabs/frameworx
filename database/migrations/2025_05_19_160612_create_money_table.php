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
        Schema::create('money', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Name of the transaction
            $table->string('type'); // Name of the transaction
            $table->decimal('amount', 10, 2); // Amount with 2 decimal places
            $table->string('transaction_id')->unique(); // Unique transaction ID
            $table->text('description')->nullable(); // Optional description
            $table->string('slug')->unique(); // Unique slug
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money');
    }
};
