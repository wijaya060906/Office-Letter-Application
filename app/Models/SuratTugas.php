<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 'surattugas';

    // Kolom yang bisa diisi mass-assignable
    protected $fillable = [
        'tanggal',
        'nomor_surat',
        'perihal',
        'kepada',
        'tujuan_penugasan',
        'klasifikasi_id',
        'file_surat',
    ];

    // Relasi dengan model Klasifikasi
    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class, 'klasifikasi_id');
    }
}
