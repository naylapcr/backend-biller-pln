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
        Schema::create('catat_meters', function (Blueprint $table) {
        $table->id();
        // foreign key ke tabel billers
        $table->foreignId('biller_id')->constrained('billers')->onDelete('cascade'); 
        $table->timestamp('waktu_mulai')->nullable();
        $table->timestamp('waktu_selesai')->nullable();
        $table->integer('lama_membaca')->nullable(); // selisih waktu dalam menit
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catat_meters');
    }
};
