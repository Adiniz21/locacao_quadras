<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Funcionário
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('all-employees.index') }}" class="mr-4" title="Voltar">
                        <i class="mr-1 icon ion-md-arrow-back"></i>
                        <span class="sr-only">Voltar</span>
                    </a>
                    Editar Funcionário
                </x-slot>

                {{-- Erros globais --}}
                @if ($errors->any())
                    <div class="mb-6 rounded-md border border-red-200 bg-red-50 p-4 text-red-700">
                        <div class="font-semibold mb-2">Corrija os campos abaixo:</div>
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" {{-- Se suas rotas não foram padronizadas com ->parameters([...=>'employees']),
                         use o array nomeado: ['all_employee' => $employees] --}} action="{{ route('all-employees.update', $employees) }}"
                    class="mt-4">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        {{-- Usuário --}}
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700">
                                @lang('crud.all_employees.inputs.user_id'):
                            </label>
                            <select id="user_id" name="user_id"
                                class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                @php $oldUser = old('user_id', $employees->user_id); @endphp
                                <option value="" disabled>@lang('crud.common.please_select') o
                                    @lang('crud.all_employees.inputs.user_id')</option>
                                @foreach ($users as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ (string) $oldUser === (string) $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Position (ENUM) --}}
                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">
                                @lang('crud.all_employees.inputs.position'):
                            </label>
                            <select id="position" name="position"
                                class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                @php
                                    // valor que deve ficar selecionado: 'old' (após validação) ou o atual do banco
                                    $currentPosition = old('position', $employees->position);
                                    // usa as opções passadas pela controller; fallback para o model
                                    $enumPositions = $positions ?? \App\Models\Employees::positions();
                                @endphp

                                <option value="" disabled>@lang('crud.common.please_select') o
                                    @lang('crud.all_employees.inputs.position')</option>

                                @foreach ($enumPositions as $opt)
                                    <option value="{{ $opt }}"
                                        {{ $currentPosition === $opt ? 'selected' : '' }}>
                                        {{ ucfirst($opt) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('position')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Salary --}}
                        <div>
                            <label for="salary" class="block text-sm font-medium text-gray-700">
                                @lang('crud.all_employees.inputs.salary'):
                            </label>
                            <input id="salary" type="number" step="0.01" min="0" name="salary"
                                class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                value="{{ old('salary', $employees->salary) }}" required />
                            @error('salary')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Hired Date (dd/mm/aaaa) --}}
                        {{-- Data de Admissão (edit) --}}
                        <div>
                            <label for="hired_date" class="block text-sm font-medium text-gray-700">
                                @lang('crud.all_employees.inputs.hired_date')
                            </label>
                            <input id="hired_date" type="text" name="hired_date"
                                class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="dd/mm/aaaa"
                                value="{{ old('hired_date', optional($employees->hired_date)->format('d/m/Y')) }}"
                                autocomplete="off" autocapitalize="off" autocorrect="off" spellcheck="false" required />
                            @error('hired_date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-10 flex items-center justify-between">
                            <a href="{{ route('all-employees.index') }}" class="button">
                                <i class="mr-1 icon ion-md-return-left text-primary"></i>
                                Voltar
                            </a>

                            <button type="submit" class="button button-primary">
                                <i class="mr-1 icon ion-md-save"></i>
                                Salvar
                            </button>
                        </div>
                </form>
            </x-partials.card>
        </div>
    </div>
    @push('scripts')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const input = document.getElementById('hired_date');
                if (input) {
                    flatpickr(input, {
                        dateFormat: 'd/m/Y',
                        allowInput: true,
                        locale: 'pt',
                        maxDate: 'today',
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
