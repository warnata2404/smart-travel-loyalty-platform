<?php

namespace App\Http\Controllers;

use App\Http\Requests\Route\StoreRouteRequest;
use App\Http\Requests\Route\UpdateRouteRequest;
use App\Models\Route;
use App\Services\Route\RouteService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class RouteController extends Controller
{
    public function __construct(
        private readonly RouteService $routeService,
    ) {}

    public function index(): View
    {
        return view('routes.index', [
            'routes' => $this->routeService->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('routes.create');
    }

    public function store(
        StoreRouteRequest $request,
    ): RedirectResponse {
        $this->routeService->create(
            $request->validated()
        );

        return redirect()
            ->route('routes.index')
            ->with(
                'success',
                'Route berhasil ditambahkan.'
            );
    }

    public function edit(
        Route $route,
    ): View {
        return view('routes.edit', [
            'route' => $route,
        ]);
    }

    public function update(
        UpdateRouteRequest $request,
        Route $route,
    ): RedirectResponse {
        $this->routeService->update(
            $route,
            $request->validated(),
        );

        return redirect()
            ->route('routes.index')
            ->with(
                'success',
                'Route berhasil diperbarui.'
            );
    }

    public function destroy(
        Route $route,
    ): RedirectResponse {
        $this->routeService->delete(
            $route,
        );

        return redirect()
            ->route('routes.index')
            ->with(
                'success',
                'Route berhasil dihapus.'
            );
    }
}
