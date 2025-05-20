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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name')->nullable(); // Menu name
            $table->string('sub_name')->nullable(); // Menu name
            $table->string('link'); // Link for the menu
            $table->string('type')->nullable(); // Type of menu (nullable)
            $table->string('slug')->unique()->nullable();  // Add a slug column
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // // Add a foreign key constraint
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
