<?php

namespace App\Http\Responses\V1;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final readonly class MessageResponse implements Responsable
{
    public function __construct(
        private readonly string $message,
        private readonly int $status = Response::HTTP_OK
    ) {}
    public function toResponse($request): Response
    {
        return new JsonResponse(
            data: [],
            status: $this->status,
        );
    }
}
