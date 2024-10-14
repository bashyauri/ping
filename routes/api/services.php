<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/',)->name('index');
Route::post('/',)->name('store');
Route::get('{services}',)->name('show');
Route::put('{service}',)->name('update');
Route::delete('{service}',)->name('delete');