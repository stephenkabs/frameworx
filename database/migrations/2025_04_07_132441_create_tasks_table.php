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

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->string('title');
                $table->foreignId('client_id')->nullable()->constrained()->onDelete('cascade');
                $table->text('description')->nullable();
                $table->string('priority')->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->bigInteger('worker_id')->nullable();
                $table->bigInteger('quotation_id')->nullable();
                $table->bigInteger('category_id')->nullable();
                $table->string('status')->nullable();
                $table->string('slug')->unique()->nullable();  // Add a slug column
                $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
