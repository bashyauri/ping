<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use TiMacDonald\JsonApi\JsonApiResource;

final class ServiceResource extends JsonApiResource
{
    public function toAttributes(Request $request): array
    {
        return [

            'name' => $this->resource->name,
            'url' => $this->resource->url,
            'created' => new DateResource(
                resource: $this->resource->created_at,
            )
        ];
    }
    public function toRelationships(Request $request): array
    {
        return [
            'checks' => fn() => CheckResource::collection(
                resource: $this->whenLoaded(
                    relationship: 'checks'
                )
            )

        ];
    }
}