<?php

namespace App\Services\Destination;

use App\Models\Destination;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DestinationService
{
    /**
     * Get paginated destinations.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Destination::query()
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get all destinations.
     */
    public function all(): Collection
    {
        return Destination::query()
            ->orderBy('name')
            ->get();
    }

    /**
     * Find destination by id.
     */
    public function find(int $id): Destination
    {
        return Destination::query()
            ->findOrFail($id);
    }

    /**
     * Create destination.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): Destination
    {
        return Destination::create($data);
    }

    /**
     * Update destination.
     *
     * @param array<string, mixed> $data
     */
    public function update(Destination $destination, array $data): Destination
    {
        $destination->update($data);

        return $destination->fresh();
    }

    /**
     * Delete destination.
     */
    public function delete(Destination $destination): bool
    {
        return (bool) $destination->delete();
    }
}
