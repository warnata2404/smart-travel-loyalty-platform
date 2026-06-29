<?php

namespace App\Http\Controllers;

use App\Http\Requests\Destination\StoreDestinationRequest;
use App\Http\Requests\Destination\UpdateDestinationRequest;
use App\Models\Destination;
use App\Services\Destination\DestinationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DestinationController extends Controller
{
    public function __construct(
        private readonly DestinationService $destinationService,
    ) {}

    public function index(): View
    {
        $destinations = $this->destinationService->paginate();

        return view('destinations.index', [
            'destinations' => $destinations,
        ]);
    }

    public function create(): View {}

    public function store(
        StoreDestinationRequest $request,
    ): RedirectResponse {}

    public function edit(
        Destination $destination,
    ): View {}

    public function update(
        UpdateDestinationRequest $request,
        Destination $destination,
    ): RedirectResponse {}

    public function destroy(
        Destination $destination,
    ): RedirectResponse {}
}
