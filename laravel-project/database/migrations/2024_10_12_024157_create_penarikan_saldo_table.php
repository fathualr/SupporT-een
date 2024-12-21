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
        Schema::create('penarikan_saldo', function (Blueprint $table) {
            $table->id(); // Primary key, ID unik untuk setiap penarikan saldo
            $table->unsignedBigInteger('id_user')->nullable(); // Foreign key untuk merujuk pada pengguna
            $table->enum('status', ['menunggu', 'ditolak', 'disetujui']); // Status penarikan
            $table->decimal('jumlah_penarikan', 10, 2); // Jumlah saldo
            $table->string('provider', 50); // Penyedia pembayaran
            $table->string('nomor_tujuan', 50); // Nomor tujuan
            $table->string('bukti_buku_tabungan', 255);
            $table->string('pesan_penarikan', 255)->nullable(); // Pesan tambahan (opsional)
            $table->string('bukti_transfer', 255)->nullable(); // Bukti transfer
            $table->timestamp('approved_at')->nullable(); // Waktu persetujuan
            $table->timestamps(); // created_at dan updated_at

            // Menambahkan foreign key constraint untuk id_user
            $table->foreign('id_user')->references('id')->on('user')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penarikan_saldo');
    }
};
