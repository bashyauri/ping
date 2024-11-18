<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Services;

use App\Enums\CacheKey;
use App\Http\Resources\V1\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

final class IndexController
{
    public function __invoke(): Response
    {
        // Cache all services for the current user
        Cache::forever(
            CacheKey::User_services->value . '_' . auth()->id(),
            Service::query()->where('user_id', '=', auth()->id())->get(),
        );

        // Create the query directly from the Service model
        $services = QueryBuilder::for(
            Service::query() // Pass the query builder, not a collection
        )->allowedIncludes(
            includes: 'checks',
        )->allowedFilters(
            filters: ['url'],
        )->where(
            'user_id',
            '=',
            auth()->user()->id()
        )->simplePaginate(
            perPage: config('app.pagination.limit')
        );

        return new JsonResponse(
            data: ServiceResource::collection(resource: $services),
        );
    }
}
