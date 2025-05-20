<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfitsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('profits', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount_paid', 15, 2); // Profit balance
            $table->decimal('amount_spent', 15, 2)->nullable(); // Profit balance
            $table->date('date')->nullable(); // Profit balance
            $table->string('note')->nullable(); // Optional note
            $table->unsignedBigInteger('quotation_id'); // Related quotation
            $table->string('slug')->unique(); // Unique slug
            $table->unsignedBigInteger('user_id'); // User who created the profit
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('profits');
    }
}
