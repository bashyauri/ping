<?php

declare(strict_types=1);

use App\Http\Controllers\V1\Checks\DeleteController;
use App\Http\Controllers\V1\Checks\IndexController;
use App\Http\Controllers\V1\Checks\ShowController;
use App\Http\Controllers\V1\Checks\StoreController;
use App\Http\Controllers\V1\Checks\UpdateController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('{checks}', ShowController::class)->name('show');
Route::put('{checks}', UpdateController::class)->name('update');
Route::delete('{checks}', DeleteController::class)->name('delete');
