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
        Schema::create('pesan_konsultasi', function (Blueprint $table) {
            $table->id(); // Primary key, ID unik untuk setiap pesan
            $table->uuid('id_konsultasi'); // Foreign key untuk merujuk pada sesi konsultasi
            $table->enum('pengirim', ['tenaga ahli', 'pasien']); // Pihak yang mengirimkan pesan
            $table->string('pesan', 255); // Isi text yang dikirim sebagai pesan
            $table->string('pesan_gambar', 255)->nullable(); // Gambar yang dikirim dalam pesan
            $table->boolean('is_showed_to_patient'); // Status apakah pesan ditampilkan ke pasien
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            // Menambahkan foreign key constraint untuk id_konsultasi
            $table->foreign('id_konsultasi')->references('id')->on('konsultasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan_konsultasi');
    }
};
