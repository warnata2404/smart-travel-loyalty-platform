<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoyaltyRule\StoreLoyaltyRuleRequest;
use App\Http\Requests\LoyaltyRule\UpdateLoyaltyRuleRequest;
use App\Models\LoyaltyRule;
use App\Services\Loyalty\LoyaltyRuleService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoyaltyRuleController extends Controller
{
    public function __construct(
        private readonly LoyaltyRuleService $loyaltyRuleService,
    ) {}

    public function index(): View
    {
        return view('loyalty-rules.index', [
            'loyaltyRules' => $this->loyaltyRuleService->paginate(),
        ]);
    }

    public function create(): View
    {
        return view('loyalty-rules.create');
    }

    public function store(
        StoreLoyaltyRuleRequest $request,
    ): RedirectResponse {
        $this->loyaltyRuleService->create(
            $request->validated()
        );

        return redirect()
            ->route('loyalty-rules.index')
            ->with(
                'success',
                'Loyalty Rule berhasil ditambahkan.'
            );
    }

    public function edit(
        LoyaltyRule $loyaltyRule,
    ): View {
        return view('loyalty-rules.edit', [
            'loyaltyRule' => $loyaltyRule,
        ]);
    }

    public function update(
        UpdateLoyaltyRuleRequest $request,
        LoyaltyRule $loyaltyRule,
    ): RedirectResponse {
        $this->loyaltyRuleService->update(
            $loyaltyRule,
            $request->validated(),
        );

        return redirect()
            ->route('loyalty-rules.index')
            ->with(
                'success',
                'Loyalty Rule berhasil diperbarui.'
            );
    }

    public function destroy(
        LoyaltyRule $loyaltyRule,
    ): RedirectResponse {
        $this->loyaltyRuleService->delete(
            $loyaltyRule,
        );

        return redirect()
            ->route('loyalty-rules.index')
            ->with(
                'success',
                'Loyalty Rule berhasil dihapus.'
            );
    }
}
