<?php

namespace App\Http\Controllers;

use App\Models\SuratUndangan;
use Illuminate\Http\Request;

class SuratUndanganController extends Controller
{
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
           $filePath = $request->file('template_surat')->storeAs(
    'templates',
    time().'_'.$request->file('template_surat')->getClientOriginalName(),
    'public'
);
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

        return redirect()->route('surattugas.create')->with('success', 'Agenda berhasil disimpan!');
    }


    public function store(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nomor_surat' => 'required|string|max:255',
    ]);

    // Cari surat berdasarkan ID
    $surat = SuratUndangan::find($id);
    if (!$surat) {
        abort(404, 'Surat tidak ditemukan');
    }

    // Update nomor surat
    $surat->nomor_surat = $request->nomor_surat;
    $surat->save(); // Simpan ke database

    return redirect()->route('admin.undangan.undangan')->with('success', 'Nomor surat berhasil disimpan!');
}


public function download($id)
{
    $surat = SuratUndangan::find($id);

    if (!$surat || !$surat->template_surat) {
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    $filePath = storage_path('app/public/' . $surat->template_surat);

    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'File tidak ditemukan di server.');
    }

    return response()->download($filePath);
}

public function uploadNaskah(Request $request, $id)
{
    // Validasi file
    $request->validate([
        'naskah_surat' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);

    // Cari surat berdasarkan ID
    $surat = SuratUndangan::find($id);
    if (!$surat) {
        return redirect()->back()->with('error', 'Surat tidak ditemukan.');
    }

    // Simpan file ke storage
    $filePath = $request->file('naskah_surat')->storeAs(
        'naskah_surat',
        time() . '_' . $request->file('naskah_surat')->getClientOriginalName(),
        'public'
    );

    // Simpan path file ke database
    $surat->naskah_surat = $filePath;
    $surat->save();

    return redirect()->back()->with('success', 'Naskah surat berhasil diunggah.');
}

public function downloadNaskah($id)
{
    $surat = SuratUndangan::find($id);

    if (!$surat || !$surat->naskah_surat) {
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    $filePath = storage_path('app/public/' . $surat->naskah_surat);

    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'File tidak ditemukan di server.');
    }

    return response()->download($filePath);
}


}