<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('analytics', function () {
    return Inertia::render('Analytics');
})->middleware(['auth', 'verified'])->name('analytics');

Route::get('transactions', [TransactionController::class, 'index']
)->middleware(['auth', 'verified'])->name('transactions');

Route::get('/profile/categories', [CategoryController::class, 'index']
)->middleware(['auth', 'verified'])->name('categories');


Route::middleware('auth')->group(function () {

    Route::get('/profile/edit', function () {
        return Inertia::render('Profile/EditProfile');
    })->middleware(['auth', 'verified'])->name('editprofile');

    Route::get('/profile/password', function () {
        return Inertia::render('Profile/EditPassword');
    })->middleware(['auth', 'verified'])->name('editpassword');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/transactions', [TransactionController::class, 'store'])->name('transaction.store');
    Route::patch('/transactions/{id}', [TransactionController::class, 'update'])->name('transaction.update');
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');

    Route::post('/profile/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::patch('/profile/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/profile/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

});

require __DIR__.'/auth.php';
