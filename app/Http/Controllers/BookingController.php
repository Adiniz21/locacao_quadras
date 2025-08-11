<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Booking, Court};
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()
            ->with('court.venue')
            ->orderByDesc('start_at')
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking); // opcional se tiver policy
        $booking->load('court.venue');
        return view('bookings.show', compact('booking'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'court_id' => ['required','exists:courts,id'],
            'start_at' => ['required','date'],
            'end_at'   => ['required','date','after:start_at'],
        ]);

        $start = Carbon::parse($data['start_at']);
        $end   = Carbon::parse($data['end_at']);

        if (Booking::overlaps($data['court_id'], $start, $end)) {
            return back()->with('success', 'Esse horário acabou de ser reservado. Tente outro.'); // usando notyf de sucesso p/ simplicidade
        }

        $court = Court::findOrFail($data['court_id']);
        $hours = max(1, $start->diffInMinutes($end) / 60);
        $price = (int) round($court->hourly_price * 100 * $hours);

        $booking = Booking::create([
            'user_id'     => auth()->id(),
            'court_id'    => $court->id,
            'start_at'    => $start,
            'end_at'      => $end,
            'status'      => 'confirmed',
            'price_cents' => $price,
        ]);

        return redirect()->route('bookings.show', $booking)->with('success', 'Reserva confirmada!');
    }
}
