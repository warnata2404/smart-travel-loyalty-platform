<?php

namespace App\Http\Controllers;

use App\Http\Requests\Destination\StoreDestinationRequest;
use App\Http\Requests\Destination\UpdateDestinationRequest;
use App\Models\Destination;
use App\Services\Destination\DestinationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class DestinationController extends Controller
{
    public function __construct(
        private readonly DestinationService $destinationService,
    ) {}

    public function index(): View
    {
        return view('destinations.index', [
            'destinations' => $this->destinationService->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('destinations.create');
    }

    public function store(
        StoreDestinationRequest $request,
    ): RedirectResponse {
        $this->destinationService->create(
            $request->validated()
        );

        return redirect()
            ->route('destinations.index')
            ->with(
                'success',
                'Destination berhasil ditambahkan.'
            );
    }

    public function edit(
        Destination $destination,
    ): View {
        return view('destinations.edit', [
            'destination' => $destination,
        ]);
    }

    public function update(
        UpdateDestinationRequest $request,
        Destination $destination,
    ): RedirectResponse {
        $this->destinationService->update(
            $destination,
            $request->validated(),
        );

        return redirect()
            ->route('destinations.index')
            ->with(
                'success',
                'Destination berhasil diperbarui.'
            );
    }

    public function destroy(
        Destination $destination,
    ): RedirectResponse {
        $this->destinationService->delete(
            $destination,
        );

        return redirect()
            ->route('destinations.index')
            ->with(
                'success',
                'Destination berhasil dihapus.'
            );
    }
}
