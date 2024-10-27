<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Services;

use App\Http\Requests\V1\Services\StoreRequest;
use App\Http\Resources\V1\ServiceResource;
use App\Jobs\Services\CreateNewService;
use App\Models\Service;
use Illuminate\Bus\Dispatcher;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class StoreController
{
    public function __construct(
        private readonly Dispatcher $bus
    ) {}
    public function __invoke(StoreRequest $request): Response
    {
        $this->bus->dispatch(
            command: new CreateNewService(
                payload: $request->payload()
            )
        );
       return new
    }
}