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
        dd($request->all());

        return redirect()->route('surattugas.create')->with('success', 'Agenda berhasil disimpan!');
    }
}