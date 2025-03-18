<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Início') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <!-- Usamos max-w-5xl para deixar mais largo e flex justify-center para centralizar -->
        <div class="max-w-5xl mx-auto flex justify-center px-4 sm:px-6 lg:px-8">
            <!-- Caixa branca com shadow -->
            <div class="bg-white shadow-xl sm:rounded-lg p-8 flex flex-col items-center justify-center mt-10">
                <!-- Aumente o w-72, w-80 ou w-96 conforme preferir -->
                <img 
                    src="{{ asset('images/logos/logo_esporte_facil.jpg') }}" 
                    alt="Esporte Fácil Logo" 
                    class="w-82 h-82 mb-4"
                >
                
                <h1 class="text-2xl font-bold text-gray-800">
                    Bem-vindo ao Esporte Fácil!
                </h1>
                
            </div>
        </div>
    </div>
</x-app-layout>
