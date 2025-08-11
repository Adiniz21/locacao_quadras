<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Minhas reservas</h2></x-slot>
  <div class="p-6 space-y-3">
    @forelse($reservations as $r)
      <a href="{{ route('reservations.show',$r) }}" class="block bg-white rounded-xl shadow p-4 hover:shadow-md">
        <div class="font-medium">{{ $r->facility->name ?? 'Local' }} — {{ $r->facility->venue->name ?? '' }}</div>
        <div class="text-sm text-gray-500">
          {{ optional($r->start_at)->format('d/m H:i') }}–{{ optional($r->end_at)->format('H:i') }}
          • {{ ucfirst($r->payment_status) }}
        </div>
      </a>
    @empty
      <div class="text-gray-500">Você ainda não tem reservas.</div>
    @endforelse
  </div>
</x-app-layout>
