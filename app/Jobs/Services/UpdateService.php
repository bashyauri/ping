<?php

namespace App\Jobs\Services;

use App\Http\Payloads\V1\CreateService;
use App\Models\Service;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Queue\Queueable;

use function PHPUnit\Framework\callback;

class UpdateService implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public readonly CreateService $payload,
        public readonly Service $service
    ) {
        //
    }


    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: fn() => $this->service->update(
                attributes: $this->payload->toArray()
            ),
            attempts: 3,
        );
    }
}