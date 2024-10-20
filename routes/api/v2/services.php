<?php

declare(strict_types=1);



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V2\Services\ShowController;
use App\Http\Controllers\V2\Services\IndexController;
use App\Http\Controllers\V2\Services\StoreController;
use App\Http\Controllers\V2\Services\DeleteController;
use App\Http\Controllers\V2\Services\UpdateController;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('{service}', ShowController::class)->name('show');
Route::put('{service}', UpdateController::class)->name('update');
Route::delete('{service}', DeleteController::class)->name('delete');
