<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surat_undangans', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->date('tanggal_surat'); // Tanggal surat
            $table->string('nomor_surat')->Unique()->nullable(); // Nomor surat, bisa kosong dulu
            $table->string('perihal'); // Perihal surat
            $table->string('kepada'); // Penerima surat
            $table->enum('permohonan_tempat', ['ya', 'tidak'])->default('tidak'); // Permohonan tempat/aula
            $table->enum('permohonan_konsumsi', ['ya', 'tidak'])->default('tidak'); // Permohonan konsumsi
            $table->dateTime('penyelenggaraan_mulai'); // Tanggal & waktu mulai acara
            $table->dateTime('penyelenggaraan_selesai'); // Tanggal & waktu selesai acara
            $table->unsignedBigInteger('klasifikasi_id'); // Foreign key ke tabel klasifikasi
            $table->string('template_surat')->nullable(); // Template surat yang diunggah
            $table->string('naskah_surat')->nullable(); // File naskah surat
            $table->timestamps(); // created_at & updated_at

            // Foreign key constraint
            $table->foreign('klasifikasi_id')->references('id')->on('klasifikasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_undangans');
    }
};
