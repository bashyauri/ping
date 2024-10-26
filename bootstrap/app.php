<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Application;
use Treblle\ApiResponses\Data\ApiError;
use Treblle\ErrorCodes\Enums\ErrorCode;
use App\Http\Middleware\SunsetMiddleware;
use JustSteveKing\Tools\Http\Enums\Status;
use Treblle\ApiResponses\Responses\ErrorResponse;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

        $exceptions->render(fn(NotFoundHttpException|ModelNotFoundException $exception, Request $request) => new ErrorResponse(
            data: new ApiError(
                title: 'Not Found',
                detail: $exception->getMessage(),
                instance: $request->path(),
                code: ErrorCode::NOT_FOUND->value,
                link: 'https://docs.domain.com/errors/not-found',
            ),
            status: Status::NOT_FOUND,
        ));
    })->create();
