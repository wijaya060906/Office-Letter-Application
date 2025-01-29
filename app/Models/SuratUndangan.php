<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratUndangan extends Model
{
    use HasFactory;

    protected $table = 'surat_undangans'; // Nama tabel di database

    protected $fillable = [
        'tanggal_surat',
        'nomor_surat',
        'perihal',
        'kepada',
        'permohonan_tempat',
        'permohonan_konsumsi',
        'penyelenggaraan_mulai',
        'penyelenggaraan_selesai',
        'klasifikasi_id',
        'template_surat',
        'naskah_surat'
    ];

    // Relasi ke tabel klasifikasi
    public function klasifikasi()
    {
        return $this->belongsTo(Klasifikasi::class, 'klasifikasi_id');
    }
}
