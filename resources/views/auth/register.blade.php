@extends('layouts.guest')

@section('content')
  {{-- Wrapper = viewport - header - footer (inclui margin-top do footer) --}}
  <div id="auth-wrapper"
       class="min-h-[calc(100dvh-var(--header-h)-var(--footer-h))] lg:min-h-[calc(100vh-var(--header-h)-var(--footer-h))] flex overflow-hidden"
       style="--header-h:64px; --footer-h:0px;">

    {{-- ESQUERDA: formulário (rola sozinho se precisar) --}}
    <div class="flex-1 flex items-center justify-center p-6 sm:p-8 lg:p-12 overflow-auto">
      <div class="w-full max-w-sm sm:max-w-md text-center bg-white p-6 rounded-2xl shadow-xl">
        <h2 class="text-3xl font-bold mb-6 text-gray-900">Registre-se</h2>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="text-left">
            <x-label for="name" value="{{ __('Nome') }}" />
            <x-input id="name" class="block mt-1 w-full focus:ring-orange-500 focus:border-orange-500"
                     type="text" name="name" :value="old('name')" required autofocus
                     autocomplete="name" placeholder="Digite seu nome" />
          </div>

          <div class="mt-4 text-left">
            <x-label for="email" value="{{ __('E-mail') }}" />
            <x-input id="email" class="block mt-1 w-full focus:ring-orange-500 focus:border-orange-500"
                     type="email" name="email" :value="old('email')" required
                     autocomplete="username" placeholder="Digite seu e-mail" />
          </div>

          <div class="flex gap-4">
            <div class="flex-1 mt-4 text-left">
              <x-label for="cpf" value="{{ __('CPF') }}" />
              <x-input id="cpf" class="block mt-1 w-full focus:ring-orange-500 focus:border-orange-500"
                       type="text" name="cpf" :value="old('cpf')" required
                       autocomplete="cpf" placeholder="Digite seu CPF" />
            </div>
            <div class="flex-1 mt-4 text-left">
              <x-label for="phone" value="{{ __('Telefone') }}" />
              <x-input id="phone" class="block mt-1 w-full focus:ring-orange-500 focus:border-orange-500"
                       type="text" name="phone" :value="old('phone')" required
                       autocomplete="tel" placeholder="Digite seu telefone" />
            </div>
          </div>

          <div class="flex gap-4">
            <div class="flex-1 mt-4 text-left">
              <x-label for="password" value="{{ __('Senha') }}" />
              <x-input id="password" class="block mt-1 w-full focus:ring-orange-500 focus:border-orange-500"
                       type="password" name="password" required
                       autocomplete="new-password" placeholder="Digite sua senha" />
            </div>
            <div class="flex-1 mt-4 text-left">
              <x-label for="password_confirmation" value="{{ __('Confirme sua senha') }}" />
              <x-input id="password_confirmation" class="block mt-1 w-full focus:ring-orange-500 focus:border-orange-500"
                       type="password" name="password_confirmation" required
                       autocomplete="new-password" placeholder="Confirme sua senha" />
            </div>
          </div>

          @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4 text-left">
              <x-label for="terms">
                <div class="flex items-center">
                  <x-checkbox name="terms" id="terms" required />
                  <div class="ml-2 text-sm text-gray-600">
                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                        'terms_of_service' =>
                            '<a target="_blank" href="' .
                            route('terms.show') .
                            '" class="underline hover:text-gray-900">' .
                            __('Terms of Service') .
                            '</a>',
                        'privacy_policy' =>
                            '<a target="_blank" href="' .
                            route('policy.show') .
                            '" class="underline hover:text-gray-900">' .
                            __('Privacy Policy') .
                            '</a>',
                    ]) !!}
                  </div>
                </div>
              </x-label>
            </div>
          @endif

          <div class="flex items-center justify-end mt-6 gap-4">
            <a class="text-orange-600 hover:underline text-sm" href="{{ route('login') }}">
              {{ __('Já tem tem registro?') }}
            </a>
            <x-button class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-4 rounded-lg">
              {{ __('Registre-se') }}
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

  {{-- Mesmo script da tela de login: mede header/footer (e margin-top do footer) --}}
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
