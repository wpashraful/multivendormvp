<?php

use Illuminate\Support\Facades\Route;
use Modules\Lottery\Http\Controllers\LotteryController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('lotteries', LotteryController::class)->names('lottery');
    Route::patch('lotteries/{lottery}/status', [LotteryController::class, 'updateStatus'])->name('lottery.updateStatus');
    Route::post('lotteries/search', [LotteryController::class, 'search'])->name('lottery.search');
});
