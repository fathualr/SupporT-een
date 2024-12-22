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
        Schema::create('transaksi_konsultasi', function (Blueprint $table) {
            $table->id(); // Primary key, ID unik untuk setiap transaksi
            $table->uuid('id_konsultasi')->nullable(); // Foreign key untuk merujuk pada konsultasi terkait
            $table->string('snap_token')->unique(); // ID transaksi unik dari Midtrans
            $table->decimal('amount', 10, 2); // Jumlah pembayaran
            $table->string('payment_method')->nullable(); // Metode pembayaran (bisa kosong jika masih pending)
            $table->enum('status', ['pending', 'canceled', 'expired', 'paid', 'refunded'])->default('pending');
            $table->timestamp('expired_at')->nullable();
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            // Menambahkan foreign key constraint untuk id_konsultasi
            $table->foreign('id_konsultasi')->references('id')->on('konsultasi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
