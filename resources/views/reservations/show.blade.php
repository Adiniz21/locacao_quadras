<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Reserva</h2></x-slot>
  <div class="p-6">
    <div class="bg-white rounded-xl shadow p-6">
      <div class="text-lg font-semibold">
        {{ $reservation->facility->name ?? 'Local' }} — {{ $reservation->facility->venue->name ?? '' }}
      </div>
      <div class="text-gray-600 mt-1">{{ $reservation->facility->venue->city ?? '' }}</div>
      <div class="mt-3">
        <div><b>Quando:</b> {{ optional($reservation->start_at)->format('d/m/Y H:i') }}–{{ optional($reservation->end_at)->format('H:i') }}</div>
        <div><b>Status:</b> {{ ucfirst($reservation->payment_status) }}</div>
        <div><b>Valor:</b> R$ {{ number_format((float)$reservation->total_price,2,',','.') }}</div>
      </div>
    </div>
  </div>
</x-app-layout>
