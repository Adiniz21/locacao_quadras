@extends('layouts.guest')

@section('content')
  {{-- Wrapper = viewport - header - footer (inclui margin-top do footer) --}}
  <div id="auth-wrapper"
       class="min-h-[calc(100dvh-var(--header-h)-var(--footer-h))] lg:min-h-[calc(100vh-var(--header-h)-var(--footer-h))] flex overflow-hidden"
       style="--header-h:64px; --footer-h:0px;">

    {{-- ESQUERDA: formulário (rola se precisar) --}}
    <div class="flex-1 flex items-center justify-center p-6 sm:p-8 lg:p-12 overflow-auto">
      <div class="w-full max-w-sm sm:max-w-md text-center bg-white p-6 rounded-2xl shadow-xl">
        <h2 class="text-3xl font-bold mb-6 text-gray-900">Redefinição da Senha</h2>

        <div class="mb-4 text-sm text-gray-600">
          {{ __('Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e nós lhe enviaremos um link de redefinição de senha que permitirá que você escolha uma nova.') }}
        </div>

        @if (session('status'))
          <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
          </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
          @csrf

          <div class="text-left">
            <x-label for="email" value="{{ __('E-mail') }}" />
            <x-input id="email"
                     class="block mt-1 w-full focus:ring-orange-500 focus:border-orange-500"
                     type="email" name="email" :value="old('email')" required autofocus
                     autocomplete="username"
                     placeholder="Informe o e-mail para recuperação da senha" />
          </div>

          <div class="flex items-center justify-end mt-4">
            <x-button
              class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded-lg text-center flex items-center justify-center">
              {{ __('Redefinição de senha de e-mail') }}
            </x-button>
          </div>
        </form>
      </div>
    </div>

    {{-- DIREITA: imagem (segue a altura do wrapper) --}}
    <div class="hidden lg:block lg:flex-1 overflow-hidden">
      <div class="h-full w-full bg-cover bg-center"
           style="background-image: url('{{ asset('images/login/login.jpg') }}');"></div>
    </div>
  </div>

  {{-- Mede header/footer + margin-top do footer e aplica nas variáveis --}}
  <script>
    (function () {
      function applyHeights() {
        const header = document.querySelector('header');
        const footer = document.querySelector('footer');

        const headerH = header ? header.getBoundingClientRect().height : 0;
        const footerH = footer ? footer.getBoundingClientRect().height : 0;
        const footerMT = footer ? parseFloat(getComputedStyle(footer).marginTop || '0') : 0;

        const wrap = document.getElementById('auth-wrapper');
        if (wrap) {
          wrap.style.setProperty('--header-h', headerH + 'px');
          wrap.style.setProperty('--footer-h', (footerH + footerMT) + 'px');
        }
      }
      window.addEventListener('load', applyHeights);
      window.addEventListener('resize', applyHeights);
    })();
  </script>
@endsection
