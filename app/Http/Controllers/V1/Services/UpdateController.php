<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Services;

use App\Models\Service;

use App\Jobs\Services\UpdateService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Bus\Dispatcher;
use App\Http\Resources\V1\ServiceResource;
use App\Http\Responses\V1\MessageResponse;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\V1\Services\WriteRequest;
use Illuminate\Validation\UnauthorizedException;

final readonly class UpdateController
{
    public function __construct(
        private readonly Dispatcher $bus
    ) {}
    public function __invoke(WriteRequest $request, Service $service): Responsable
    {
        if (!Gate::allows('update', $service)) {
            throw new UnauthorizedException(
                message: __('services.v1.update.failure'),
                code: Response::HTTP_FORBIDDEN,
            );
        }
        $this->bus->dispatch(
            command: new UpdateService(
                payload: $request->payload(),
                service: $service
            ),
        );
        return new MessageResponse(
            message: __('services.v1.update.success'),
            status: Response::HTTP_ACCEPTED,
        );
    }
}