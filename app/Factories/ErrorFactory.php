<?php

declare(strict_types=1);

namespace App\Factories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Throwable;
use Illuminate\Http\Request;
use Treblle\ApiResponses\Data\ApiError;
use JustSteveKing\Tools\Http\Enums\Status;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Treblle\ApiResponses\Responses\ErrorResponse;

final class ErrorFactory
{
    public static function create(Throwable $exception, Request $request): ErrorResponse
    {

        return match ($exception::class) {
            NotFoundHttpException::class, ModelNotFoundException::class => new ErrorResponse(
                data: new ApiError(
                    title: 'Resource not found.',
                    detail: 'The requested resource could not be found.',
                    instance: $request->fullUrl(),
                    code: 'HTTP-404',
                    link: 'https://docs.treblle.com/errors/404'
                ),
                status: Status::NOT_FOUND,
            ),

            MethodNotAllowedHttpException::class,
            MethodNotAllowedException::class => new ErrorResponse(
                data: new ApiError(
                    title: 'Method not allowed.',
                    detail: "You are trying to do a {$request->getMethod()} on an endpoint that only allows " .
                        (method_exists($exception, 'getAllowedMethods') ? implode(', ', $exception->getAllowedMethods()) : 'specified methods'),
                    instance: $request->fullUrl(),
                    code: 'HTTP-405',
                    link: 'https://docs.treblle.com/errors/405'
                ),
                status: Status::METHOD_NOT_ALLOWED
            ),
            default => new ErrorResponse(
                data: new ApiError(
                    title: 'Something went wrong.',
                    detail: 'Something went wrong.',
                    instance: $request->fullUrl(),
                    code: 'SER-500',
                    link: 'https://docs.treblle.com/errors/500'

                ),
                status: Status::INTERNAL_SERVER_ERROR
            ),
        };
    }
}
