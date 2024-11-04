<?php

declare(strict_types=1);

use App\Http\Controllers\v1\Services\DeleteController;
use App\Http\Controllers\v1\Services\IndexController;
use App\Http\Controllers\v1\Services\ShowController;
use App\Http\Controllers\v1\Services\StoreController;
use App\Http\Controllers\v1\Services\UpdateController;
use Illuminate\Support\Facades\Route;
use Spatie\ResponseCache\Middlewares\CacheResponse;

Route::post('/', StoreController::class)->name('store');
Route::middleware([CacheResponse::class])->group(static function (): void {
    Route::get('/', IndexController::class)->name('index');
    Route::get('{ulid}', ShowController::class)->name('show');
});

Route::put('{service}', UpdateController::class)->name('update');
Route::delete('{service}', DeleteController::class)->name('delete');
