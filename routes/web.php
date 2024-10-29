<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HarvestController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('/product', ProductController::class)->middleware('role:admin');
    Route::resource('/harvest', HarvestController::class)->middleware('role:admin');
    Route::resource('/stock', StockController::class)->middleware('role:admin');
    Route::resource('/transaction', TransactionController::class)->middleware('role:admin');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('admin', function () {
    return '<h1>Hello admin</h1>';
})->middleware(['auth', 'verified', 'role:admin']);

Route::get('penulis', function () {
    return '<h1>Hello penulis</h1>';
})->middleware(['auth', 'verified', 'role:penulis|admin']);


Route::get('tulisan', function () {
    return '<h1>Tulisan Sederhana</h1>';
})->middleware(['auth', 'verified', 'role_or_permission:lihat-tulisan|admin']);

require __DIR__ . '/auth.php';
