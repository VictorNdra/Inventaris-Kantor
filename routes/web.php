<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController; // Tambahkan ini
use App\Http\Controllers\LaporanController;  // Tambahkan untuk fitur laporan nanti
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Barang;

// --- GUEST ROUTES ---
Route::get('/', function() { return redirect()->route('login'); });
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/register-proses',[AuthController::class,'registerProses'])->name('register_proses');

// --- AUTHENTICATED ROUTES ---
Route::middleware(['auth'])->group(function () {
    
    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // DASHBOARD
    Route::get('admin/dashboard', function () {
        $total_barang = Barang::count(); 
        $barang_tersedia = Barang::where('status', 'tersedia')->count();
        $barang_rusak = Barang::where('kondisi', 'rusak')->count();

        return view('admin.dashboard', compact('total_barang', 'barang_tersedia', 'barang_rusak'));
    })->name('admin.dashboard');

    // MANAJEMEN BARANG
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');

    
    Route::get('/kategori', [CategoryController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [CategoryController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/{id}', [CategoryController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('kategori.destroy');
    
    
    Route::get('/export-barang', [BarangController::class, 'exportExcel'])->name('barang.export');
});