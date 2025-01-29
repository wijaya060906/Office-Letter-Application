<?php

namespace App\Http\Controllers;

use App\Models\SuratTugas;
use App\Models\SuratUndangan;
use Illuminate\Http\Request;

class SuratTugasController extends Controller
{
    private function generateNomorSurat($klasifikasiId)
    {
        $tahun = now()->year; // Tahun saat ini
        $kodeInstansi = '33080'; // kode instansi 
        $prefix = 'B'; // Prefix surat

        // Hitung jumlah surat yang sudah ada untuk klasifikasi tertentu di tahun ini
        $jumlahSurat = SuratTugas::where('klasifikasi_id', $klasifikasiId)
            ->whereYear('created_at', $tahun)
            ->count();

        // Tambahkan satu untuk nomor surat baru
        $nomorSurat = $prefix . str_pad($jumlahSurat + 1, 2, '0', STR_PAD_LEFT);

        // Gabungkan nomor surat sesuai format
        return "{$nomorSurat}/{$kodeInstansi}/{$klasifikasiId}/{$tahun}";
    }

    /**
     * Store a new Surat Tugas.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'kepada' => 'required|string|max:255',
            'tujuan_penugasan' => 'required|string',
            'klasifikasi_id' => 'required|exists:klasifikasi,id',
            'file_surat' => 'nullable|file|mimes:pdf|max:930016',
        ]);

        // Generate nomor surat jika tidak diberikan
        $nomorSurat = $request->nomor_surat ?: $this->generateNomorSurat($request->klasifikasi_id);

        $filePath = null; // Inisialisasi filePath

        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $fileName = $file->getClientOriginalName();
        
            // Simpan file ke folder public/surattugas
            $file->move(public_path('surattugas'), $fileName);
        
            // Simpan nama file ke database
            $filePath = $fileName;
            \Log::info('File stored with original name: ' . $fileName);
        } else {
            $filePath = null; // Nilai null jika tidak ada file
            \Log::info('No file uploaded.');
        }
        
        // Simpan data ke database
        SuratTugas::create([
            'tanggal' => $request->tanggal,
            'nomor_surat' => $nomorSurat,
            'perihal' => $request->perihal,
            'kepada' => $request->kepada,
            'tujuan_penugasan' => $request->tujuan_penugasan,
            'klasifikasi_id' => $request->klasifikasi_id,
            'file_surat' => $filePath, // Pastikan hanya nama file atau null
        ]);

        return redirect()->route('user.surattugas.surattugas')->with('success', 'Surat tugas berhasil ditambahkan!');
    }

    /**
     * Generate nomor surat via AJAX.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'klasifikasi_id' => 'required|exists:klasifikasi,id',
        ]);

        $nomorSurat = $this->generateNomorSurat($request->klasifikasi_id);

        return response()->json(['nomor_surat' => $nomorSurat]);
    }

    /**
     * Upload file surat.
     */
    public function upload(Request $request, $id)
    {
        // Validasi file upload
        $request->validate([
            'file_surat' => 'required|mimes:pdf|max:2048', // Hanya menerima file PDF dengan ukuran maksimal 2MB
        ]);

        // Cari surat berdasarkan ID
        $surat = SuratTugas::findOrFail($id);

        // Simpan file ke storage
        if ($request->hasFile('file_surat')) {
            $file = $request->file('file_surat');
            $fileName = $file->getClientOriginalName();
        
            // Simpan file ke folder public/surattugas
            $file->move(public_path('surattugas'), $fileName);
        
            // Update kolom file_surat di database
            $surat->file_surat = $fileName; // Hanya nama file
            $surat->save();
        }
        

        return redirect()->back()->with('success', 'File berhasil diunggah.');
    }

    /**
     * Unduh file surat berdasarkan ID.
     */
    


     public function storeundangan(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal_surat' => 'required|date',
            'perihal' => 'required|string|max:255',
            'kepada' => 'required|string|max:255',
            'permohonan_tempat' => 'required|in:ya,tidak',
            'permohonan_konsumsi' => 'required|in:ya,tidak',
            'penyelenggaraan_mulai' => 'required|date',
            'penyelenggaraan_selesai' => 'required|date|after_or_equal:penyelenggaraan_mulai',
            'klasifikasi_id' => 'required|integer',
            'template_surat' => 'nullable|file|mimes:pdf,doc,docx|max:930016',
        ]);

        // Simpan file jika ada
        if ($request->hasFile('template_surat')) {
            $filePath = $request->file('template_surat')->store('templates', 'public');
        } else {
            $filePath = null;
        }

        // Simpan ke database
        SuratUndangan::create([
            'tanggal_surat' => $request->tanggal_surat,
            'perihal' => $request->perihal,
            'kepada' => $request->kepada,
            'permohonan_tempat' => $request->permohonan_tempat,
            'permohonan_konsumsi' => $request->permohonan_konsumsi,
            'penyelenggaraan_mulai' => $request->penyelenggaraan_mulai,
            'penyelenggaraan_selesai' => $request->penyelenggaraan_selesai,
            'klasifikasi_id' => $request->klasifikasi_id,
            'template_surat' => $filePath,
        ]);
        dd($request->all());

        return redirect()->route('surattugas.create')->with('success', 'Agenda berhasil disimpan!');
    }
}
