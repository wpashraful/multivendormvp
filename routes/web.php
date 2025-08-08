<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

    // Routes are now handled by modules
    // Categories: Modules\Category
    // Products: Modules\Product
    


    //profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
