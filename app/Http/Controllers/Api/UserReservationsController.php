<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\ReservationCollection;

class UserReservationsController extends Controller
{
    public function index(Request $request, User $user): ReservationCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $reservations = $user
            ->reservations()
            ->search($search)
            ->latest()
            ->paginate();

        return new ReservationCollection($reservations);
    }

    public function store(Request $request, User $user): ReservationResource
    {
        $this->authorize('create', Reservation::class);

        $validated = $request->validate([
            'sports_facilities_id' => [
                'required',
                'exists:sports_facilities,id',
            ],
            'reservation_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i:s'],
            'end_time' => ['required', 'date_format:H:i:s'],
            'total_price' => ['required', 'numeric'],
            'payment_status' => ['required', 'in:{IMPLODED_OPTIONS}'],
            'recurrence' => ['required', 'in:{IMPLODED_OPTIONS}'],
            'notification_sent' => ['required', 'boolean'],
        ]);

        $reservation = $user->reservations()->create($validated);

        return new ReservationResource($reservation);
    }
}
