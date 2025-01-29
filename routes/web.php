<?php

use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\SuratUndanganController;
use App\Models\Klasifikasi;
use App\Models\SuratTugas;
use App\Models\SuratUndangan;
use App\Models\UndanganModel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman dashboard admin
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/klasifikasi', function () {
        $klasifikasi = Klasifikasi::all();
        return view('admin.klasifikasi.klasifikasi', compact('klasifikasi'));
    })->name('admin.klasifikasi');

    Route::post('/klasifikasi', [KlasifikasiController::class, 'create'])->name('klasifikasi.store');
    Route::put('/klasifikasi/{id}', [KlasifikasiController::class, 'update'])->name('klasifikasi.update');
    Route::delete('/klasifikasi/{id}', [KlasifikasiController::class, 'destroy'])->name('klasifikasi.destroy');

    Route::get('/admin/klasifikasi/create', function(){
        return view('admin.klasifikasi.create');
    })->name('klasifikasi.create');

    Route::get('/admin/klasifikasi/update/{id}', function ($id) {
        $klasifikasi = Klasifikasi::findOrFail($id);
        return view('admin.klasifikasi.update', compact('klasifikasi'));
    })->name('klasifikasi.edit');

    Route::get('/admin/surattugas',function(){
        $SuratTugas = SuratTugas::all();
        return view('admin.surattugas.suratTugas',compact('SuratTugas'));
    })->name('admin.surattugas.surattugas');
    
});



Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/user/surattugas',function(){
        $SuratTugas = SuratTugas::all();
        return view('user.surat tugas.suratTugas',compact('SuratTugas'));
    })->name('user.surattugas.surattugas');

    Route::get('/user/undangan',function(){
        $Undangan = SuratUndangan::with('klasifikasi')->get();
        return view('user.undangan.undangan',compact('Undangan'));
    })->name('user.undangan.undangan');

    
    Route::get('/user/surattugas/create', function () {
        $klasifikasi = Klasifikasi::all(); // Ambil semua data klasifikasi
        return view('user.surat tugas.create', compact('klasifikasi'));
    })->name('surattugas.create');
    
    Route::post('/undangan/create', [SuratUndanganController::class, 'storeundangan'])->name('undangan.store');
    Route::get('/user/undangan/create',function(){
        $klasifikasi = Klasifikasi::all();
        return view('user.undangan.create', compact('klasifikasi'));
    })->name('undangan.create');

    Route::post('/surattugas/create', [SuratTugasController::class, 'store'])->name('surattugas.store');
    Route::post('/surattugas/generate', [SuratTugasController::class, 'generate'])->name('surattugas.generate');
    Route::post('/surat/{id}/upload', [SuratTugasController::class, 'upload'])->name('surat.upload');
});

require __DIR__.'/auth.php';
