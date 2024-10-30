<?php

declare(strict_types=1);



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\Services\ShowController;
use App\Http\Controllers\v1\Services\IndexController;
use App\Http\Controllers\v1\Services\StoreController;
use App\Http\Controllers\v1\Services\DeleteController;
use App\Http\Controllers\v1\Services\UpdateController;

Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('{ulid}', ShowController::class)->name('show');
Route::put('{service}', UpdateController::class)->name('update');
Route::delete('{service}', DeleteController::class)->name('delete');
