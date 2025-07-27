<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\admin\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if(auth()->user()->role == 'admin'){
            return view('admin.dashboard');
        }
        if(auth()->user()->role == 'wholesaler'){
            return view('wholesaler.dashboard');
        }
        return view('seller.dashboard');
    })->name('dashboard');

    // category routes
    Route::resource('categories', CategoryController::class);

    //product routes
    // routes/web.php
    Route::get('products/search', [ProductController::class, 'index'])->name('products.search');
    Route::resource('products', ProductController::class);

    Route::patch('products/{id}/status', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
    


    //profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
