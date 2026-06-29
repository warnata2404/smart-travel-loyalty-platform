<?php

namespace App\Services\Route;

use App\Models\Route;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RouteService
{
    /**
     * Get paginated routes.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Route::query()
            ->with([
                'originDestination',
                'destinationDestination',
            ])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get all routes.
     */
    public function all(): Collection
    {
        return Route::query()
            ->with([
                'originDestination',
                'destinationDestination',
            ])
            ->orderBy('id')
            ->get();
    }

    /**
     * Find route by id.
     */
    public function find(int $id): Route
    {
        return Route::query()
            ->with([
                'originDestination',
                'destinationDestination',
            ])
            ->findOrFail($id);
    }

    /**
     * Create route.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Route
    {
        return Route::create($data);
    }

    /**
     * Update route.
     *
     * @param array<string, mixed> $data
     */
    public function update(
        Route $route,
        array $data,
    ): Route {
        $route->update($data);

        return $route->fresh([
            'originDestination',
            'destinationDestination',
        ]);
    }

    /**
     * Delete route.
     */
    public function delete(
        Route $route,
    ): bool {
        return (bool) $route->delete();
    }
}
