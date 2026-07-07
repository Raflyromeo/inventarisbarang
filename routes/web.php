<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventarisController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [InventarisController::class, 'dashboard'])->name('dashboard');
    
    Route::resource('inventaris', InventarisController::class)->parameters([
        'inventaris' => 'barang'
    ])->names([
        'index' => 'inventaris.index',
        'create' => 'inventaris.create',
        'store' => 'inventaris.store',
        'show' => 'inventaris.show',
        'edit' => 'inventaris.edit',
        'update' => 'inventaris.update',
        'destroy' => 'inventaris.destroy',
    ]);
});
