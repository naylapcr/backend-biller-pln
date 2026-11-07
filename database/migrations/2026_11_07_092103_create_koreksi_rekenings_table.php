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
        Schema::create('koreksi_rekenings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('biller_id')->constrained('billers')->onDelete('cascade');
        $table->integer('jumlah_minus'); // misal: 5 (poin pengurang)
        $table->string('keterangan');
        $table->date('tanggal');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koreksi_rekenings');
    }
};
