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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('restrict');
            $table->foreignId('instrument_id')->constrained()->references('id')->on('instrument')->onDelete('restrict');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_dikembalikan')->nullable();
            $table->integer('total_price')->nullable();
            $table->string('penalty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
