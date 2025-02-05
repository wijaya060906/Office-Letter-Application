<?php

use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\SuratUndanganController;
use App\Http\Controllers\UserController;
use App\Models\Klasifikasi;
use App\Models\SuratTugas;
use App\Models\SuratUndangan;
use App\Models\UndanganModel;
use App\Models\User;
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
    
    Route::get('/admin/undangan',function(){
        $Undangan = SuratUndangan::with('klasifikasi')->get();
        $surat = SuratUndangan::all();
        return view('admin.undangan.undangan',compact('Undangan','surat'));
    })->name('admin.undangan.undangan');

    Route::post('/admin/nomorsurat/{id}', [SuratUndanganController::class, 'store'])->name('undangan.nomor');
    Route::get('/surat/download/{id}', [SuratUndanganController::class, 'download'])->name('surat.download');
    Route::post('/surat/upload-naskah/{id}', [SuratUndanganController::class, 'uploadNaskah'])->name('surat.uploadNaskah');
    Route::delete('/surat/{id}', [SuratUndanganController::class, 'destroy'])->name('surat.destroy');

    Route::get('/undangan/{id}/edit', [SuratUndanganController::class, 'edit'])->name('undangan.edit');
    Route::post('/undangan/{id}/update', [SuratUndanganController::class, 'update'])->name('undangan.update');

    Route::get('/admin/pemohon',function(){
        $user = User::all();
        return view('admin.pemohon.pemohon',compact('user'));
    })->name('admin.pemohon');

    Route::get('/admin/pemohon/create',function(){
        return view('admin.pemohon.create');
    })->name('pemohon.create');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');

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
    
    Route::get('/surat/download-naskah/{id}', [SuratUndanganController::class, 'downloadNaskah'])->name('surat.downloadNaskah');
    Route::post('/surattugas/create', [SuratTugasController::class, 'store'])->name('surattugas.store');
    Route::post('/surattugas/generate', [SuratTugasController::class, 'generate'])->name('surattugas.generate');
    Route::post('/surat/{id}/upload', [SuratTugasController::class, 'upload'])->name('surat.upload');
});

require __DIR__.'/auth.php';
