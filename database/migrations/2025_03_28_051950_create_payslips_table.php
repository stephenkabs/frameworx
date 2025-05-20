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
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_id')->nullable()->constrained('salaries')->onDelete('set null'); // Foreign key with constraint
            $table->bigInteger('detail_id')->nullable();
            $table->date('date')->nullable(); // Proper date type
            $table->string('prepared_by')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('slug')->unique()->nullable(); // Unique slug column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};

