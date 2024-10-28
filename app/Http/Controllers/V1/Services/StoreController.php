<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Services;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Bus\Dispatcher;
use Illuminate\Support\Facades\Gate;
use App\Jobs\Services\CreateNewService;
use App\Http\Resources\V1\ServiceResource;
use App\Http\Responses\V1\MessageResponse;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\V1\Services\StoreRequest;
use App\Http\Requests\V1\Services\WriteRequest;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

final readonly class StoreController
{
    public function __construct(
        private readonly Dispatcher $bus
    ) {}
    public function __invoke(WriteRequest $request): Response| Responsable
    {
        if (!Gate::allows('create', Service::class)) {
            throw new UnauthorizedException(
                message: 'You must verify your email before creating a new service.',
                code: Response::HTTP_FORBIDDEN,
            );
        }
        $this->bus->dispatch(
            command: new CreateNewService(
                payload: $request->payload()
            )
        );
        return new MessageResponse(
            message: 'Your service will be created at the background.',
            status: Response::HTTP_ACCEPTED,
        );
    }
}