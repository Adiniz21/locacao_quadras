<x-guest-layout>
    <div class="flex min-h-screen">
        <!-- Lado esquerdo: Formulário de login -->
        <div class="w-1/2 h-screen flex flex-col justify-center items-center bg-white">
            <div class="w-full max-w-md text-center">
                <!-- Logo -->
                <div class="mb-6 flex justify-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Imobidrive" class="w-40">
                </div>

                <h2 class="text-3xl font-bold mb-6 text-gray-900">Login</h2>

                <x-validation-errors class="mb-4" />

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="w-full space-y-4">
                    @csrf

                    <div class="text-left">
                        <x-label for="email" class="block text-gray-700 font-semibold" value="E-mail" />
                        <x-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg px-3 py-2"
                            type="email" name="email" placeholder="Digite seu e-mail" required autofocus />
                    </div>

                    <div class="text-left">
                        <x-label for="password" class="block text-gray-700 font-semibold" value="Senha" />
                        <x-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg px-3 py-2"
                            type="password" name="password" placeholder="Insira sua senha" required />
                    </div>

                    <div class="flex justify-between items-center text-left">
                        <label class="flex items-center">
                            <x-checkbox id="remember_me" name="remember" />
                            <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-orange-500 hover:underline" href="{{ route('password.request') }}">
                                Esqueci minha senha
                            </a>
                        @endif
                    </div>

                    <div>
                        <x-button
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg">
                            Entrar
                        </x-button>
                    </div>

                    <p class="text-sm text-gray-600 text-center">
                        Ainda não tem uma conta? <a href="{{ route('register') }}"
                            class="text-orange-500 hover:underline">Cadastre-se</a>
                    </p>
                </form>
            </div>
        </div>


        <div class="w-1/2 h-screen bg-cover bg-center"
            style="background-image: url('{{ asset('images/login/login.jpg') }}');">
        </div>

    </div>
</x-guest-layout>
