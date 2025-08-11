<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{Reservation, SportsFacility, Venue};

class Dashboard extends Component
{
    public bool $isOwner = false;
    public $upcoming;
    public array $ownerStats = [];

    private int $openHour = 8;
    private int $closeHour = 22;

    public function mount(): void
    {
        $user = auth()->user();
        $this->isOwner = Venue::where('owner_id', $user->id)->exists();

        // Próximas reservas do usuário
        $this->upcoming = Reservation::query()
            ->where('user_id', $user->id)
            ->where(function($q){
                $q->where('reservation_date', '>', today()->toDateString())
                  ->orWhere(function($q2){
                      $q2->whereDate('reservation_date', today()->toDateString())
                         ->where('start_time', '>=', now()->format('H:i'));
                  });
            })
            ->with('facility.venue')
            ->orderBy('reservation_date')->orderBy('start_time')
            ->limit(5)->get();

        // Métricas do dono
        $this->ownerStats = [
            'today_bookings' => 0,
            'occupancy'      => 0,
            'revenue'        => 0,
            'pending'        => 0,
            'pending_list'   => [],
        ];

        if ($this->isOwner) {
            $venueIds    = Venue::where('owner_id',$user->id)->pluck('id');
            $facilityIds = SportsFacility::whereIn('venue_id',$venueIds)->pluck('id');

            // Hoje
            $today = today()->toDateString();
            $this->ownerStats['today_bookings'] = Reservation::whereIn('sports_facilities_id',$facilityIds)
                ->where('reservation_date',$today)->count();

            // Receita mês
            $mStart = now()->startOfMonth()->toDateString();
            $mEnd   = now()->endOfMonth()->toDateString();
            $this->ownerStats['revenue'] = (float) Reservation::whereIn('sports_facilities_id',$facilityIds)
                ->whereBetween('reservation_date', [$mStart,$mEnd])
                ->whereIn('payment_status', ['confirmed','paid'])
                ->sum('total_price');

            // Pendências
            $this->ownerStats['pending'] = Reservation::whereIn('sports_facilities_id',$facilityIds)
                ->where('payment_status','pending')->count();

            $this->ownerStats['pending_list'] = Reservation::whereIn('sports_facilities_id',$facilityIds)
                ->where('payment_status','pending')
                ->orderBy('reservation_date')->orderBy('start_time')
                ->limit(5)->get()
                ->map(fn($r) => [
                    'title' => sprintf('%s (%s–%s)',
                        optional($r->facility)->name,
                        optional($r->start_at)->format('d/m H:i'),
                        optional($r->end_at)->format('H:i')
                    ),
                    'url' => route('reservations.show', $r),
                ])->toArray();

            // Ocupação (mês)
            $bookedMinutes = Reservation::whereIn('sports_facilities_id',$facilityIds)
                ->whereBetween('reservation_date', [$mStart,$mEnd])
                ->whereIn('payment_status',['confirmed','paid'])
                ->get()
                ->sum(fn($r) => max(0, optional($r->start_at)?->diffInMinutes(optional($r->end_at)) ?? 0));

            $daysInMonth = now()->startOfMonth()->daysInMonth;
            $operationalMinutesPerDay = max(0, ($this->openHour - $this->closeHour) * -60); // 22-8 => 14*60
            $capacity = $operationalMinutesPerDay * $daysInMonth * max(1, $facilityIds->count());
            $this->ownerStats['occupancy'] = $capacity > 0 ? round($bookedMinutes / $capacity * 100, 1) : 0;
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
