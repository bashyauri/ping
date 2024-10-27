<?php

declare(strict_types=1);

namespace App\Http\Payloads\V1;

final class CreateService
{
    public function __construct(
        private readonly string $name,
        private readonly string $url,
        private readonly string $user
    ) {}
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'user_id' => $this->user,
        ];
    }
}
