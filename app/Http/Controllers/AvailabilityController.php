<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{SportsFacility, Reservation};
use Illuminate\Support\Carbon;

class AvailabilityController extends Controller
{
    public function index(Request $request)
    {
        $q     = $request->string('q')->toString();
        $date  = $request->input('date', now()->toDateString());
        $time  = $request->input('time', '19:00');
        $dur   = (int) $request->input('duration', 60);

        $start = Carbon::parse("$date $time");
        $end   = (clone $start)->addMinutes($dur);

        $facilities = SportsFacility::with('venue')
            ->when($q, fn($qr) =>
                $qr->where('name','like',"%$q%")
                   ->orWhere('city','like',"%$q%")
                   ->orWhereHas('venue', fn($v)=>$v->where('name','like',"%$q%")->orWhere('city','like',"%$q%"))
            )
            ->orderBy('name')
            ->get();

        $results = $facilities->map(function ($f) use ($date, $start, $end) {
            $available = ! Reservation::overlaps(
                $f->id, $date, $start->format('H:i'), $end->format('H:i')
            );
            return ['facility' => $f, 'available' => $available];
        });

        return view('availability.index', compact('results','start','end'));
    }
}
