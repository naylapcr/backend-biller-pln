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
        Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->foreignId('biller_id')->constrained('billers')->onDelete('cascade');
        $table->foreignId('work_order_id')->constrained('work_orders')->onDelete('cascade');
        $table->string('status')->default('pending'); // status invoice (pending/selesai)
        $table->date('tanggal_invoice');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
