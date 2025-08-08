<?php

use Illuminate\Support\Facades\Route;
use Modules\Tester\Http\Controllers\TesterController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('testers', TesterController::class)->names('tester');
});
