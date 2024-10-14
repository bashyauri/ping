<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/',)->name('index');
Route::post('/',)->name('store');
Route::get('{checks}',)->name('show');
Route::put('{check}',)->name('update');
Route::delete('{check}',)->name('delete');