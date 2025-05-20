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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(1); // Default user_id to 1
            $table->bigInteger('folder_id')->nullable();
            $table->string('supplier_name')->nullable();
            $table->string('currency')->nullable();
            $table->string('tpin')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('invoice_amount')->nullable();
            $table->string('vat_withheld')->nullable();
            $table->string('amount_nv')->nullable();
            $table->text('description')->nullable();
            $table->text('status')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->string('slug')->unique()->nullable(); // Slug column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
