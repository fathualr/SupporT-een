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
        Schema::create('refunds_konsultasi', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('id_transaksi_konsultasi')->unique(); // Hubungan 1-to-1 dengan transaksi
            $table->decimal('refund_amount', 10, 2); // Jumlah refund
            $table->enum('refund_status', ['requested', 'in_progress', 'completed', 'failed'])->default('requested');
            $table->string('refund_reason')->nullable(); 
            $table->timestamps();
        
            // Foreign key constraints
            $table->foreign('id_transaksi_konsultasi')->references('id')->on('transaksi_konsultasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refunds');
    }
};
