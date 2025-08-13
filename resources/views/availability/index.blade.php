@extends('layouts.guest')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
  <h1 class="text-2xl font-semibold mb-6">Buscar quadras</h1>

  <form action="{{ route('availability.index') }}" method="GET"
        class="grid grid-cols-1 md:grid-cols-6 gap-3 bg-white rounded-2xl p-4 shadow-sm">
    <div class="md:col-span-2">
      <label class="text-xs text-gray-600">Cidade / Nome</label>
      <input name="q" value="{{ request('q') }}" class="mt-1 w-full rounded-xl border-gray-300" placeholder="Ex.: Centro">
    </div>
    <div>
      <label class="text-xs text-gray-600">Data</label>
      <input type="date" name="date" value="{{ request('date', now()->toDateString()) }}" class="mt-1 w-full rounded-xl border-gray-300">
    </div>
    <div>
      <label class="text-xs text-gray-600">Hora</label>
      <input type="time" name="time" value="{{ request('time','19:00') }}" class="mt-1 w-full rounded-xl border-gray-300">
    </div>
    <div>
      <label class="text-xs text-gray-600">Duração (min)</label>
      <input type="number" name="duration" min="30" step="30" value="{{ request('duration',60) }}" class="mt-1 w-full rounded-xl border-gray-300">
    </div>
    <div class="md:col-span-6 flex justify-end">
      <button class="px-5 py-3 rounded-xl bg-orange-600 text-white hover:bg-orange-700">Buscar</button>
    </div>
  </form>

  <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
    @forelse($results ?? [] as $row)
      @php($f = $row['facility'])
      <div class="bg-white rounded-xl shadow p-4 flex items-center justify-between">
        <div>
          <div class="font-semibold">{{ $f->name }} — {{ $f->venue->name ?? '' }}</div>
          <div class="text-sm text-gray-500">{{ $f->venue->city ?? '' }}</div>
          @if(!is_null($f->hourly_price))
            <div class="text-sm text-gray-500">R$ {{ number_format($f->hourly_price,2,',','.') }}/h</div>
          @endif
        </div>

        @auth
          @if($row['available'])
            <form action="{{ route('reservations.store') }}" method="POST" class="flex items-center gap-2">
              @csrf
              <input type="hidden" name="sports_facilities_id" value="{{ $f->id }}">
              <input type="hidden" name="start_at" value="{{ $start->toIso8601String() }}">
              <input type="hidden" name="end_at"   value="{{ $end->toIso8601String() }}">
              <button class="px-4 py-2 rounded-lg bg-gray-900 text-white hover:bg-black text-sm">Reservar</button>
            </form>
          @else
            <span class="text-sm text-red-600">Indisponível no horário</span>
          @endif
        @else
          <a href="{{ route('login') }}" class="text-sm text-orange-600 hover:underline">Entrar para reservar</a>
        @endauth
      </div>
    @empty
      <div class="text-gray-500">Nenhum local encontrado nos filtros.</div>
    @endforelse
  </div>
</div>
@endsection
