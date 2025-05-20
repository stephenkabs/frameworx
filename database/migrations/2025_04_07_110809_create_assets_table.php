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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('amount')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('supplier_contact')->nullable();
            $table->string('delivery_date')->nullable();
            $table->date('warrant_start_date')->nullable();
            $table->string('attachment_name')->nullable();
            $table->string('warrant_duration')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique()->nullable();  // Add a slug column
            $table->text('image')->nullable();
            $table->text('asset_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
