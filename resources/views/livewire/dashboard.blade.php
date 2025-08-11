<div class="space-y-6" wire:poll.60s>
    @if ($isOwner)
      {{-- DONO/GERENTE --}}
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow p-4">
          <div class="text-sm text-gray-500">Reservas hoje</div>
          <div class="text-2xl font-semibold">{{ $ownerStats['today_bookings'] }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
          <div class="text-sm text-gray-500">Ocupação (mês)</div>
          <div class="text-2xl font-semibold">{{ $ownerStats['occupancy'] }}%</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
          <div class="text-sm text-gray-500">Receita (mês)</div>
          <div class="text-2xl font-semibold">R$ {{ number_format($ownerStats['revenue'], 2, ',', '.') }}</div>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
          <div class="text-sm text-gray-500">Pendências</div>
          <div class="text-2xl font-semibold">{{ $ownerStats['pending'] }}</div>
        </div>
      </div>
  
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow p-4 lg:col-span-2">
          <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold">Calendário (semana)</h3>
            <div class="flex gap-2">
              <a href="{{ Route::has('venues.index') ? route('venues.index') : '#' }}" class="text-sm px-3 py-2 rounded-lg border">Minhas quadras</a>
              <a href="{{ route('availability.index') }}" class="text-sm px-3 py-2 rounded-lg bg-gray-900 text-white">Buscar horários</a>
            </div>
          </div>
          <div class="h-72 grid place-items-center text-gray-400 text-sm">[Calendário aqui]</div>
        </div>
  
        <div class="bg-white rounded-xl shadow p-4">
          <h3 class="font-semibold mb-3">Pendências</h3>
          <ul class="space-y-2 text-sm">
            @forelse(($ownerStats['pending_list'] ?? []) as $p)
              <li class="flex items-center justify-between">
                <span>{{ $p['title'] }}</span>
                <a href="{{ $p['url'] }}" class="text-orange-600 hover:underline">ver</a>
              </li>
            @empty
              <li class="text-gray-500">Nada pendente.</li>
            @endforelse
          </ul>
        </div>
      </div>
  
    @else
      {{-- USUÁRIO JOGADOR --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('availability.index') }}" class="bg-white rounded-xl shadow p-4 hover:shadow-md transition">
          <div class="text-sm text-gray-500">Começar</div>
          <div class="text-xl font-semibold">Buscar quadras</div>
          <p class="text-sm text-gray-500 mt-1">Encontre quadras livres por perto</p>
        </a>
        <a href="{{ route('bookings.index') }}" class="bg-white rounded-xl shadow p-4 hover:shadow-md transition">
          <div class="text-sm text-gray-500">Atalhos</div>
          <div class="text-xl font-semibold">Minhas reservas</div>
          <p class="text-sm text-gray-500 mt-1">Gerencie e cancele quando possível</p>
        </a>
        <a href="{{ route('favorites.index') }}" class="bg-white rounded-xl shadow p-4 hover:shadow-md transition">
          <div class="text-sm text-gray-500">Rápido</div>
          <div class="text-xl font-semibold">Favoritos</div>
          <p class="text-sm text-gray-500 mt-1">Reserve de novo em 1 clique</p>
        </a>
      </div>
  
      <div class="bg-white rounded-xl shadow p-4">
        <div class="flex items-center justify-between mb-3">
          <h3 class="font-semibold">Próximas reservas</h3>
          <a href="{{ route('bookings.index') }}" class="text-sm text-orange-600 hover:underline">ver todas</a>
        </div>
  
        <ul class="divide-y">
          @forelse($upcoming as $b)
            <li class="py-3 flex items-center justify-between text-sm">
              <div>
                <div class="font-medium">
                  {{ $b->court?->name }} — {{ $b->court?->venue?->name }}
                </div>
                <div class="text-gray-500">
                  {{-- sport é COLUNA; se um dia virar relação, esse fallback cobre os dois casos --}}
                  {{ $b->court?->sport?->name ?? $b->court?->sport }}
                  • {{ optional($b->start_at)->format('d/m H:i') }}–{{ optional($b->end_at)->format('H:i') }}
                </div>
              </div>
              <div class="flex gap-2">
                <a href="{{ route('bookings.show', $b) }}" class="px-3 py-2 rounded-lg border text-gray-700">Detalhes</a>
                <a href="{{ route('availability.index', [
                        'court' => $b->court_id,
                        'date'  => optional($b->start_at)->toDateString(),
                        'time'  => optional($b->start_at)->format('H:i')
                      ]) }}"
                   class="px-3 py-2 rounded-lg bg-gray-900 text-white">Repetir</a>
              </div>
            </li>
          @empty
            <li class="py-6 text-center text-gray-500">Você ainda não tem reservas futuras.</li>
          @endforelse
        </ul>
      </div>
    @endif
  </div>
  