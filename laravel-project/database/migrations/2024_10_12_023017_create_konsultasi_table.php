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
        Schema::create('konsultasi', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Primary key, ID unik untuk setiap konsultasi
            $table->unsignedBigInteger('id_tenaga_ahli')->nullable(); // Foreign key untuk merujuk pada tenaga ahli
            $table->unsignedBigInteger('id_pasien')->nullable(); // Foreign key untuk merujuk pada pasien
            $table->string('pesan_tenaga_ahli', 255)->nullable(); // Pesan terakhir dari tenaga ahli
            $table->enum('status', ['done', 'on going'])->nullable(); // Status konsultasi
            $table->timestamp('started_at')->nullable(); // Waktu mulai konsultasi
            $table->timestamp('ends_at')->nullable(); // Waktu berakhir konsultasi (hasil dari perhitungan)
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            // Menambahkan foreign key constraint untuk id_tenaga_ahli
            $table->foreign('id_tenaga_ahli')->references('id')->on('tenaga_ahli')->onDelete('set null');

            // Menambahkan foreign key constraint untuk id_pasien
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};
