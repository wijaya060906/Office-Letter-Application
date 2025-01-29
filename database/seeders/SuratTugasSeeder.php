<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuratTugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('surattugas')->insert([
            [
                'nomor_surat' => 'ST-001',
                'tanggal' => Carbon::now(),
                'perihal' => 'Pekerjaan Proyek A',
                'kepada' => 'John Doe',
                'tujuan_penugasan' => 'Menangani Proyek A',
                'klasifikasi_id' => 1, // Klasifikasi 'Penting'
            ],
            [
                'nomor_surat' => 'ST-002',
                'tanggal' => Carbon::now(),
                'perihal' => 'Pekerjaan Proyek B',
                'kepada' => 'Jane Smith',
                'tujuan_penugasan' => 'Menangani Proyek B',
                'klasifikasi_id' => 2, // Klasifikasi 'Biasa'
            ],
        ]);
    }
}
