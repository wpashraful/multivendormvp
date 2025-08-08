<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;
use Modules\product\Http\Controllers\ProductLotteryController;


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

 
    // product routes
    Route::get('products/{product}/lotteries/attach', [\Modules\Product\Http\Controllers\ProductLotteryController::class, 'attachForm'])->name('product.lotteries.attach');
    Route::post('products/{product}/lotteries/attach', [\Modules\Product\Http\Controllers\ProductLotteryController::class, 'storeAttachment'])->name('product.lotteries.attach.store');
    Route::get('products/search', [ProductController::class, 'index'])->name('products.search');
    Route::resource('products', ProductController::class);

    Route::patch('products/{id}/status', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
});
