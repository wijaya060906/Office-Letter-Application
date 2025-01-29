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
        Schema::create('surattugas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nomor_surat')->unique();
            $table->string('perihal');
            $table->string('kepada');
            $table->text('tujuan_penugasan');
            $table->foreignId('klasifikasi_id')->constrained('klasifikasi')->onDelete('cascade'); // Foreign key ke tabel klasifikasi
            $table->string('file_surat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surattugas');
    }
};
