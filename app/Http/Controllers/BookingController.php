<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\StoreBookingRequest;
use App\Http\Requests\Booking\UpdateBookingRequest;
use App\Models\Booking;
use App\Services\Booking\BookingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly BookingService $bookingService,
    ) {}

    /**
     * Display a listing of bookings.
     */
    public function index(): View
    {
        return view('bookings.index', [
            'bookings' => $this->bookingService->paginate(),
        ]);
    }

    /**
     * Show the form for creating a booking.
     */
    public function create(): View
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created booking.
     */
    public function store(
        StoreBookingRequest $request,
    ): RedirectResponse {
        $this->bookingService->create(
            $request->validated()
        );

        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Booking berhasil ditambahkan.'
            );
    }

    /**
     * Show the form for editing the specified booking.
     */
    public function edit(
        Booking $booking,
    ): View {
        return view('bookings.edit', [
            'booking' => $booking,
        ]);
    }

    /**
     * Update the specified booking.
     */
    public function update(
        UpdateBookingRequest $request,
        Booking $booking,
    ): RedirectResponse {
        $this->bookingService->update(
            $booking,
            $request->validated()
        );

        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Booking berhasil diperbarui.'
            );
    }

    /**
     * Remove the specified booking.
     */
    public function destroy(
        Booking $booking,
    ): RedirectResponse {
        $this->bookingService->delete(
            $booking
        );

        return redirect()
            ->route('bookings.index')
            ->with(
                'success',
                'Booking berhasil dihapus.'
            );
    }
}
