<?php

namespace Database\Seeders;

use App\Models\Klasifikasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KlasifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Klasifikasi::created([
            'nama_klasifikasi'=>'Penting',
        ]);
        Klasifikasi::created([
            'nama_klasifikasi'=>'Biasa',
        ]);
        Klasifikasi::created([
            'nama_klasifikasi'=>'Rahasia',
        ]);
    }
}
