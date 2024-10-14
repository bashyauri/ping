<?php

declare(strict_types=1);

use App\Http\Controllers\Services\DeleteController;
use App\Http\Controllers\Services\IndexController;
use App\Http\Controllers\Services\ShowController;
use App\Http\Controllers\Services\StoreController;
use App\Http\Controllers\Services\UpdateController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('{service}', ShowController::class)->name('show');
Route::put('{service}', UpdateController::class)->name('update');
Route::delete('{service}', DeleteController::class)->name('delete');
