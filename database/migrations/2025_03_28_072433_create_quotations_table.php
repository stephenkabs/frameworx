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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('delivery_status');
            $table->string('status');
            $table->text('quotation_note');
            $table->string('tax_name')->nullable();
            $table->float('tax_percentage')->nullable();
            $table->float('tax_amount')->default(0);
            $table->float('grand_total')->default(0);
            $table->string('slug')->unique();  // Add a unique 'slug' column
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('detail_id');
            $table->bigInteger('client_id');
            $table->bigInteger('account_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
