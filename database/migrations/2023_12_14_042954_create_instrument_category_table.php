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
        Schema::create('instrument_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->references('id')->on('category')->onDelete('cascade');
            $table->foreignId('instrument_id')->constrained()->references('id')->on('instrument')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrument_category');
    }
};
