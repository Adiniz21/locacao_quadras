@extends('layouts.guest')

@section('content')
  {{-- HERO --}}
  <section class="relative overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-gradient-to-br from-orange-50 via-white to-white"></div>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
      <div class="grid md:grid-cols-2 gap-10 items-center">
        <div>
          <h1 class="text-3xl md:text-5xl font-bold leading-tight">
            Encontre <span class="text-orange-600">quadras livres</span> perto de você e
            reserve em segundos.
          </h1>
          <p class="mt-4 text-gray-600">
            Mostramos a disponibilidade em tempo real para futebol, vôlei, tênis e muito mais.
            Sem ligações, sem complicação — é escolher o horário e jogar.
          </p>
          <div class="mt-6 flex gap-3">
            <a href="#como-funciona" class="px-5 py-3 rounded-xl border border-gray-300 hover:bg-gray-50">Saiba mais</a>
            <a href="{{ route('login') }}" class="px-5 py-3 rounded-xl bg-orange-600 text-white hover:bg-orange-700">Entrar</a>
            <a href="{{ route('register') }}" class="px-5 py-3 rounded-xl bg-gray-900 text-white hover:bg-black hidden sm:inline-flex">Criar conta</a>
          </div>
          <p class="mt-3 text-sm text-gray-500">Criar conta é grátis. Você paga apenas pelas reservas.</p>
        </div>
        <div class="relative">
          <img src="{{ asset('images\landing_page\imagem_landing_page.png') }}" class="rounded-3xl shadow-xl w-full" alt="Reserva de quadras">
        </div>
      </div>
    </div>
  </section>

  {{-- COMO FUNCIONA --}}
  <section id="como-funciona" class="py-14 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-2xl font-semibold">Como funciona</h2>
      <div class="mt-8 grid sm:grid-cols-3 gap-6">
        <div class="rounded-2xl bg-white border p-6">
          <div class="text-sm font-medium text-orange-600">1. Busque</div>
          <p class="mt-2 text-gray-700">Filtre por cidade/bairro, modalidade e data. Mostramos apenas horários livres.</p>
        </div>
        <div class="rounded-2xl bg-white border p-6">
          <div class="text-sm font-medium text-orange-600">2. Reserve</div>
          <p class="mt-2 text-gray-700">Escolha o horário, confirme e receba a confirmação por e-mail.</p>
        </div>
        <div class="rounded-2xl bg-white border p-6">
          <div class="text-sm font-medium text-orange-600">3. Jogue</div>
          <p class="mt-2 text-gray-700">Chegue na hora marcada. Envie o convite para os amigos em 1 clique.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- BENEFÍCIOS --}}
  <section id="beneficios" class="py-14">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid md:grid-cols-2 gap-8">
        <div class="rounded-2xl border p-6">
          <h3 class="text-xl font-semibold">Para quem joga</h3>
          <ul class="mt-4 space-y-2 text-gray-700">
            <li>• Disponibilidade em tempo real</li>
            <li>• Preço por hora transparente</li>
            <li>• Histórico e re-reserva rápida</li>
            <li>• Lembretes por e-mail</li>
          </ul>
        </div>
        <div class="rounded-2xl border p-6">
          <h3 class="text-xl font-semibold">Para donos de quadra</h3>
          <ul class="mt-4 space-y-2 text-gray-700">
            <li>• Painel para gerenciar horários</li>
            <li>• Bloqueio de agenda e feriados</li>
            <li>• Relatórios de ocupação</li>
            <li>• Mais visibilidade e reservas</li>
          </ul>
          <a href="{{ route('register') }}" class="inline-block mt-4 px-4 py-2 rounded-xl bg-gray-900 text-white">Anuncie sua quadra</a>
        </div>
      </div>
    </div>
  </section>

  {{-- PROVA SOCIAL --}}
  <section class="py-14 bg-gray-50">
    <div class="max-w-4xl mx-auto text-center px-4">
      <p class="text-lg text-gray-700">
        “A ocupação das nossas quadras aumentou e os clientes amaram a praticidade.”
      </p>
      <div class="mt-3 text-sm text-gray-500">— Arena Central, SP</div>
    </div>
  </section>

  {{-- CTA FINAL --}}
  <section class="py-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="rounded-2xl border p-8 md:p-10 text-center bg-white">
        <h3 class="text-2xl font-semibold">Pronto para reservar sua próxima partida?</h3>
        <p class="mt-2 text-gray-600">Crie sua conta grátis e veja quadras próximas agora mesmo.</p>
        <div class="mt-6 flex justify-center gap-3">
          <a href="{{ route('login') }}" class="px-5 py-3 rounded-xl border border-gray-300 hover:bg-gray-50">Entrar</a>
          <a href="{{ route('register') }}" class="px-5 py-3 rounded-xl bg-orange-600 text-white hover:bg-orange-700">Criar conta</a>
        </div>
      </div>
    </div>
  </section>
@endsection
