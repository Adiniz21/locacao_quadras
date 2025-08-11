@extends('layouts.guest')

@section('content')
  {{-- Wrapper ocupa: viewport - header - footer.
       Fallback: header 64px (h-16), footer 0 até o JS medir. --}}
  <div id="auth-wrapper"
       class="min-h-[calc(100dvh-var(--header-h)-var(--footer-h))] lg:min-h-[calc(100vh-var(--header-h)-var(--footer-h))] flex overflow-hidden"
       style="--header-h:64px; --footer-h:0px;">

    {{-- ESQUERDA: formulário (se crescer, rola sozinho) --}}
    <div class="flex-1 flex items-center justify-center p-6 sm:p-8 lg:p-12 overflow-auto">
      <div class="w-full max-w-sm sm:max-w-md bg-white rounded-2xl shadow-xl p-6 sm:p-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-900 text-center">Login</h2>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
          <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
          @csrf

          <div>
            <x-label for="email" class="block text-gray-700 font-semibold" value="E-mail" />
            <x-input id="email" type="email" name="email" placeholder="Digite seu e-mail" required autofocus
                     class="mt-1 w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-orange-500 focus:border-orange-500" />
          </div>

          <div>
            <x-label for="password" class="block text-gray-700 font-semibold" value="Senha" />
            <x-input id="password" type="password" name="password" placeholder="Insira sua senha" required
                     class="mt-1 w-full border-gray-300 rounded-lg px-3 py-2 focus:ring-orange-500 focus:border-orange-500" />
          </div>

          <div class="flex items-center justify-between">
            <label class="flex items-center">
              <input type="checkbox" name="remember" id="remember_me"
                     class="appearance-none h-5 w-5 border-2 border-gray-300 rounded
                            checked:bg-orange-500 checked:border-transparent
                            focus:outline-none focus:ring-2 focus:ring-orange-500 cursor-pointer" />
              <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
            </label>

            @if (Route::has('password.request'))
              <a class="text-sm text-orange-600 hover:underline" href="{{ route('password.request') }}">
                Esqueci minha senha
              </a>
            @endif
          </div>

          <x-button class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded-lg flex items-center justify-center">
            Entrar
          </x-button>

          <p class="text-sm text-gray-600 text-center">
            Ainda não tem uma conta?
            <a href="{{ route('register') }}" class="text-orange-600 hover:underline">Cadastre-se</a>
          </p>
        </form>
      </div>
    </div>

    {{-- DIREITA: imagem (segue a altura do wrapper) --}}
    <div class="hidden lg:block lg:flex-1 overflow-hidden">
      <div class="h-full w-full bg-center bg-cover"
           style="background-image:url('{{ asset('images/login/login.jpg') }}');"></div>
    </div>
  </div>

  {{-- Mede header/footer do layout atual e injeta nas variáveis --}}
  <script>
    (function () {
      function applyHeights() {
        var header = document.querySelector('header');
        var footer = document.querySelector('footer');
        var h = header ? header.offsetHeight : 0;
        var f = footer ? footer.offsetHeight : 0;
        var wrap = document.getElementById('auth-wrapper');
        if (wrap) {
          wrap.style.setProperty('--header-h', h + 'px');
          wrap.style.setProperty('--footer-h', f + 'px');
        }
      }
      window.addEventListener('load', applyHeights);
      window.addEventListener('resize', applyHeights);
    })();
  </script>
@endsection
