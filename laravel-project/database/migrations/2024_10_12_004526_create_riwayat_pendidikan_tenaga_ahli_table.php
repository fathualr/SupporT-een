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
        Schema::create('riwayat_pendidikan_tenaga_ahli', function (Blueprint $table) {
            $table->id(); // Primary key, ID unik untuk setiap riwayat pendidikan
            $table->unsignedBigInteger('id_tenaga_ahli'); // Foreign key merujuk pada tabel tenaga ahli
            $table->string('keterangan', 255); // Nama institusi pendidikan

            // Definisi foreign key
            $table->foreign('id_tenaga_ahli')->references('id')->on('tenaga_ahli')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pendidikan_tenaga_ahli');
    }
};
