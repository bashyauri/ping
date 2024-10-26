<?php

declare(strict_types=1);

use App\Factories\ErrorFactory;
use Illuminate\Http\Request;

use Illuminate\Foundation\Application;

use App\Http\Middleware\SunsetMiddleware;

use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web/routes.php',
        api: __DIR__ . '/../routes/api/routes.php',
        commands: __DIR__ . '/../routes/console.php',
        apiPrefix: '',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'sunset' => SunsetMiddleware::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(fn(UnprocessableEntityHttpException $exception, Request $request) => new JsonResponse(
            data: $exception->getMessage(),
            status: 422,
            headers: [],

        ));
        $exceptions->render(fn(Throwable $exception, Request $request) => ErrorFactory::create(
            exception: $exception,
            request: $request
        ));
    })->create();
