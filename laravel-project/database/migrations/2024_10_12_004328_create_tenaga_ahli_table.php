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
        Schema::create('tenaga_ahli', function (Blueprint $table) {
            $table->id(); // Primary key, ID unik untuk setiap tenaga ahli
            $table->unsignedBigInteger('id_user'); // Foreign key merujuk pada ID pengguna di tabel Users
            $table->string('nomor_str', 20); // Nomor STR tenaga ahli
            $table->string('spesialisasi', 50); // Spesialisasi tenaga ahli
            $table->string('jadwal_aktif', 255); // Jadwal aktif untuk konsultasi
            $table->string('lokasi_praktik', 255)->nullable(); // Lokasi praktik fisik (jika ada), bisa null
            $table->decimal('biaya_konsultasi', 10, 2); // Biaya konsultasi per sesi
            $table->decimal('tabungan', 10, 2)->default(0.00); // Saldo hasil konsultasi yang diterima
            $table->boolean('is_available')->default(false);

            // Definisi foreign key
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenaga_ahli');
    }
};
