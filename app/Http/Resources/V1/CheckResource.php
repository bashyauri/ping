<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use TiMacDonald\JsonApi\JsonApiResource;

final class CheckResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->resource->name,
            'path' => $this->resource->path,

        ];
    }
}
