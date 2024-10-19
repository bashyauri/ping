<?php

declare(strict_types=1);

use App\Http\Controllers\Checks\DeleteController;
use App\Http\Controllers\Checks\IndexController;
use App\Http\Controllers\Checks\ShowController;
use App\Http\Controllers\Checks\StoreController;
use App\Http\Controllers\Checks\UpdateController;
use Illuminate\Support\Facades\Route;



Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('{checks}', ShowController::class)->name('show');
Route::put('{checks}', UpdateController::class)->name('update');
Route::delete('{checks}', DeleteController::class)->name('delete');