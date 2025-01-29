<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SuratUndanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('surat_undangans')->insert([
            [
                'tanggal_surat' => Carbon::now()->subDays(10),
                'nomor_surat' => '001/SU/2025',
                'perihal' => 'Undangan Rapat Koordinasi',
                'kepada' => 'Kepala Departemen IT',
                'permohonan_tempat' => 'ya',
                'permohonan_konsumsi' => 'tidak',
                'penyelenggaraan_mulai' => Carbon::now()->addDays(5)->setTime(9, 0, 0),
                'penyelenggaraan_selesai' => Carbon::now()->addDays(5)->setTime(12, 0, 0),
                'klasifikasi_id' => 1, // Pastikan ID ini ada di tabel klasifikasi
                'template_surat' => 'template1.docx',
                'naskah_surat' => 'naskah1.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_surat' => Carbon::now()->subDays(5),
                'nomor_surat' => '002/SU/2025',
                'perihal' => 'Undangan Seminar Teknologi',
                'kepada' => 'Manajer Proyek',
                'permohonan_tempat' => 'tidak',
                'permohonan_konsumsi' => 'ya',
                'penyelenggaraan_mulai' => Carbon::now()->addDays(10)->setTime(14, 0, 0),
                'penyelenggaraan_selesai' => Carbon::now()->addDays(10)->setTime(17, 0, 0),
                'klasifikasi_id' => 1, // Sesuaikan dengan data di tabel klasifikasi
                'template_surat' => 'template2.docx',
                'naskah_surat' => 'naskah2.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
