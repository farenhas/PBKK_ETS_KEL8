<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController; // Import ItemsController dengan namespace yang benar
use App\Http\Controllers\SuppliersController; // Import SuppliersController dengan namespace yang benar

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers.index');
