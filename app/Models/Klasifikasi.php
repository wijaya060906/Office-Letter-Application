<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasifikasi extends Model
{
    use HasFactory;

    protected $table = 'klasifikasi';

    protected $fillable = [
        'nama_klasifikasi',
    ];


    public function surattugas()
    {
        return $this->hasMany(SuratTugas::class, 'klasifikasi_id');
    }
}
