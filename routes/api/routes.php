<?php




declare(strict_types=1);


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->as('v1:')->group(static function (): void {
    Route::get('/', fn() => response()->json(request()->route()));
    Route::middleware(['auth:sanctum', 'throttle:api'])->group(
        static function (): void {
            Route::get('/user', static function (Request $request) {
                return $request->user();
            })->name('user');
            Route::prefix('services')->as('services:')->group(base_path(
                path: 'routes/api/v1/services.php',
            ))->middleware(['throttle:100,1']);
            Route::prefix('credentials')->as('credentials:')->group(base_path(
                path: 'routes/api/v1/credentials.php',
            ));
            Route::prefix('checks')->as('checks:')->group(base_path(
                path: 'routes/api/v1/checks.php',
            ));
        }
    );
});
