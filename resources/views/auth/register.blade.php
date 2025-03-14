<x-guest-layout>

    <div class="flex min-h-screen">
        <!-- Lado esquerdo: Formulário de login -->
        <div class="w-1/2 h-screen flex flex-col justify-center items-center bg-white">
            <div class="w-full max-w-md text-center">




                <div class="flex flex-col items-center">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/register/icon.png') }}" alt="Logo" class="w-40 h-40 mb-0">
                    </a>
                </div>




                <x-validation-errors class="mb-4" />


                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="text-left">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Digite seu nome" />
                    </div>

                    <div class="text-left mt-4">
                        <x-label for="cpf" value="{{ __('CPF') }}" />
                        <x-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required autofocus autocomplete="cpf" placeholder="Digite seu cpf" />
                    </div>

                    <div class="mt-4 text-left">
                        <x-label for="email" value="{{ __('E-mail') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Digite seu e-mail" />
                    </div>


                    <div class="flex">
                        <div class=" w-1/2 mr-4 mt-4 text-left">
                            <x-label for="password" value="{{ __('Senha') }}" />
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Digite sua senha" />
                        </div>

                        <div class="w-1/2 mt-4 text-left">
                            <x-label for="password_confirmation" value="{{ __('Confirme sua senha') }}" />
                            <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme sua senha" />
                        </div>
                    </div>


                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div class="mt-4">
                                            <x-label for="terms">
                                                <div class="flex items-center">
                                                    <x-checkbox name="terms" id="terms" required />

                                                    <div class="ml-2">
                                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' . __('Terms of Service') . '</a>',
                            'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' . __('Privacy Policy') . '</a>',
                        ]) !!}
                                                    </div>
                                                </div>
                                            </x-label>
                                        </div>
                    @endif

                    <div class="flex items-center justify-end mt-4">
                        <a class=" text-orange-500 hover:underline" href=" {{ route('login') }}">
                            {{ __('Já tem tem registro?') }}
                        </a>

                        <x-button class="ml-4" style="background-color: #f97316; color: white;">
                            {{ __('Registre-se') }}
                        </x-button>

                    </div>

                </form>


            </div>
        </div>
        <div class="w-1/2 h-screen bg-cover bg-center" style="background-image: url('{{ asset('images/login/login.jpg') }}');">
        </div>
    </div>
</x-guest-layout>