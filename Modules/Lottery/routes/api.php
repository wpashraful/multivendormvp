<?php

use Illuminate\Support\Facades\Route;
use Modules\Lottery\Http\Controllers\LotteryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('lotteries', LotteryController::class)->names('lottery');
});
