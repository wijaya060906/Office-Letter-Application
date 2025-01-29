<?php

namespace App\Http\Controllers;

use App\Models\Klasifikasi;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'nama_klasifikasi' => 'required|string|max:255',
        ]);

        $klasifikasi = Klasifikasi::create([
            'nama_klasifikasi' => $request->nama_klasifikasi,
        ]);

        return redirect()->route('admin.klasifikasi');
    }

    /**
     * Update an existing Klasifikasi.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_klasifikasi' => 'required|string|max:255',
        ]);

        $klasifikasi = Klasifikasi::findOrFail($id);
        $klasifikasi->update([
            'nama_klasifikasi' => $request->nama_klasifikasi,
        ]);

       return redirect()->route('admin.klasifikasi');
    }

    /**
     * Delete a Klasifikasi.
     */
    public function destroy($id)
    {
        $klasifikasi = Klasifikasi::findOrFail($id);
        $klasifikasi->delete();

        return redirect()->route('admin.klasifikasi');
    }
}
