<?php

use Illuminate\Support\Facades\Route;
use Modules\Tester\Http\Controllers\TesterController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('testers', TesterController::class)->names('tester');
});
