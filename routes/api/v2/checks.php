<?php

declare(strict_types=1);


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V2\Checks\ShowController;
use App\Http\Controllers\V2\Checks\IndexController;
use App\Http\Controllers\V2\Checks\StoreController;
use App\Http\Controllers\V2\Checks\DeleteController;
use App\Http\Controllers\V2\Checks\UpdateController;




Route::get('/', IndexController::class)->name('index');
Route::post('/', StoreController::class)->name('store');
Route::get('{checks}', ShowController::class)->name('show');
Route::put('{checks}', UpdateController::class)->name('update');
Route::delete('{checks}', DeleteController::class)->name('delete');
