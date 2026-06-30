<?php

namespace App\Http\Controllers;

use App\Http\Requests\Voucher\StoreVoucherRequest;
use App\Http\Requests\Voucher\UpdateVoucherRequest;
use App\Models\Voucher;
use App\Services\Voucher\VoucherService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class VoucherController extends Controller
{
    /**
     * Voucher service instance.
     */
    public function __construct(
        private readonly VoucherService $voucherService
    ) {}

    /**
     * Display a listing of vouchers.
     */
    public function index(): View
    {
        return view('vouchers.index', [
            'vouchers' => $this->voucherService->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new voucher.
     */
    public function create(): View
    {
        return view('vouchers.create');
    }

    /**
     * Store a newly created voucher.
     */
    public function store(
        StoreVoucherRequest $request
    ): RedirectResponse {
        $this->voucherService->create(
            $request->validated()
        );

        return redirect()
            ->route('vouchers.index')
            ->with(
                'success',
                'Voucher berhasil ditambahkan.'
            );
    }

    /**
     * Show the form for editing the specified voucher.
     */
    public function edit(
        Voucher $voucher
    ): View {
        return view('vouchers.edit', [
            'voucher' => $voucher,
        ]);
    }

    /**
     * Update the specified voucher.
     */
    public function update(
        UpdateVoucherRequest $request,
        Voucher $voucher
    ): RedirectResponse {
        $this->voucherService->update(
            $voucher,
            $request->validated()
        );

        return redirect()
            ->route('vouchers.index')
            ->with(
                'success',
                'Voucher berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified voucher.
     */
    public function destroy(
        Voucher $voucher
    ): RedirectResponse {
        $this->voucherService->delete($voucher);

        return redirect()
            ->route('vouchers.index')
            ->with(
                'success',
                'Voucher berhasil dihapus.'
            );
    }
}
