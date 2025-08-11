<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Esporte Fácil') }}</title>

  {{-- Fontes opcionais --}}
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  {{-- Tailwind via Vite (padrão do Breeze/Jetstream) --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-white">
  {{-- NAVBAR --}}
  <header class="border-b bg-white/80 backdrop-blur sticky top-0 z-30">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <a href="{{ route('home') }}" class="flex items-center gap-2 font-semibold">
        <img src="{{ asset('images/logos/esporte_facil_logo.jpg') }}" alt="Logo" class="w-15 h-12">
        {{-- <span>{{ config('app.name', 'Esporte Fácil') }}</span> --}}
      </a>

      @php
        $onHome = request()->routeIs('home'); // exibe anchors só na home
      @endphp
      <nav class="flex items-center gap-3">
        @if ($onHome)
          <a href="#como-funciona" class="hidden md:inline-block text-sm text-gray-600 hover:text-gray-900">
            Como funciona
          </a>
          <a href="#beneficios" class="hidden md:inline-block text-sm text-gray-600 hover:text-gray-900">
            Benefícios
          </a>
        @endif

        <a href="{{ route('login') }}"
           class="px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-50 text-sm">
          Entrar
        </a>
        <a href="{{ route('register') }}"
           class="px-4 py-2 rounded-lg bg-orange-600 text-white hover:bg-orange-700 text-sm">
          Criar conta
        </a>
      </nav>
    </div>
  </header>

  {{-- CONTEÚDO DA PÁGINA --}}
  <main>
    @yield('content')
  </main>

  {{-- RODAPÉ --}}
  <footer class="border-t">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 text-center text-sm text-gray-500">
      © {{ date('Y') }} {{ config('app.name', 'Esporte Fácil') }}. Todos os direitos reservados.
    </div>
  </footer>
</body>
</html>
