<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\LandingController;

// Landing Page (publik)
Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [InventarisController::class, 'dashboard'])->name('dashboard');

    // Inventaris resource
    Route::resource('inventaris', InventarisController::class)->parameters([
        'inventaris' => 'barang'
    ])->names([
        'index'   => 'inventaris.index',
        'create'  => 'inventaris.create',
        'store'   => 'inventaris.store',
        'show'    => 'inventaris.show',
        'edit'    => 'inventaris.edit',
        'update'  => 'inventaris.update',
        'destroy' => 'inventaris.destroy',
    ]);

    // Autocomplete untuk pencarian
    Route::get('/inventaris-autocomplete', [InventarisController::class, 'autocomplete'])->name('inventaris.autocomplete');

    // Trash (Tong Sampah) - Soft Delete Management
    Route::get('/inventaris-trash', [InventarisController::class, 'trash'])->name('inventaris.trash');
    Route::post('/inventaris-trash/{id}/restore', [InventarisController::class, 'restore'])->name('inventaris.restore');
    Route::delete('/inventaris-trash/{id}/force-delete', [InventarisController::class, 'forceDelete'])->name('inventaris.force-delete');

    // Secure file serving (file disimpan di storage private, bukan public)
    Route::get('/inventaris/{barang}/foto', [InventarisController::class, 'serveFoto'])->name('inventaris.foto');
    Route::get('/inventaris/{barang}/manual', [InventarisController::class, 'serveFileManual'])->name('inventaris.manual');
});
