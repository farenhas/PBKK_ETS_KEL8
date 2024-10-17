<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuppliersController; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('items', ItemsController::class);

    
    Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create', [SuppliersController::class, 'create'])->name('suppliers.create');
    Route::post('/suppliers', [SuppliersController::class, 'store'])->name('suppliers.store');
    Route::get('/suppliers/{supplier}', [SuppliersController::class, 'show'])->name('suppliers.show');
    Route::get('/suppliers/{supplier}/edit', [SuppliersController::class, 'edit'])->name('suppliers.edit');
    Route::put('/suppliers/{supplier}', [SuppliersController::class, 'update'])->name('suppliers.update');
    Route::delete('/suppliers/{supplier}', [SuppliersController::class, 'destroy'])->name('suppliers.destroy');
});

// Include auth routes
require __DIR__.'/auth.php';
