<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/',)->name('index');
Route::post('/',)->name('store');
Route::get('{credentials}',)->name('show');
Route::put('{credential}',)->name('update');
Route::delete('{credential}',)->name('delete');