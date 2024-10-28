<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Services;

use App\Http\Responses\V1\MessageResponse;
use App\Jobs\Services\DeleteService;
use App\Models\Service;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\UnauthorizedException;


final readonly class DeleteController
{
    public function __construct(
        private readonly Dispatcher $bus
    ) {}
    public function __invoke(Request $request, Service $service): MessageResponse
    {
        if (!Gate::allows('delete', $service)) {
            throw new UnauthorizedException(
                message: 'You cannot delete a service that you do not own.',
                code: Response::HTTP_FORBIDDEN,
            );
        }
        $this->bus->dispatch(
            command: new DeleteService(
                service: $service
            )
        );
        return new MessageResponse(
            message: 'Your service will be deleted in the background.',
            status: Response::HTTP_ACCEPTED,
        );
    }
}