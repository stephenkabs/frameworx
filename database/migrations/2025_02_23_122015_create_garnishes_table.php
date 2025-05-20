<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('garnishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('document_id');
            $table->text('comment');
            $table->string('slug')->unique(); // Removed `->after('comment')`
            $table->decimal('amount', 10, 2);
            $table->string('signature')->nullable();
            $table->text('signature_pad')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('garnishes');
    }
};
