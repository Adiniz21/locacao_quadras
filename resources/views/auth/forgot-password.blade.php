<x-guest-layout>

    <div class="flex min-h-screen">


        <!-- Lado esquerdo: Formulário de login -->
        <div class="w-1/2 h-screen flex flex-col justify-center items-center">

            <div class="w-full max-w-md text-center bg-white p-6 rounded-lg shadow-lg">
                <x-slot name="logo">

                </x-slot>

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

                    <div class="block text-left">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block  mt-1 w-full focus:ring-orange-500 focus:border-orange-500"
                            type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                            placeholder="Informe o email para recuperação da senha" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button
                            class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg text-center flex items-center justify-center">
                            {{ __('
                            Redefinição de senha de e-mail') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-1/2 h-screen bg-cover bg-center"
            style="background-image: url('{{ asset('images/login/login.jpg') }}');">
        </div>
    </div>


</x-guest-layout>
