<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.all_employees.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('all-employees.index') }}" class="mr-4" title="@lang('crud.common.back')">
                        <i class="mr-1 icon ion-md-arrow-back"></i>
                        <span class="sr-only">@lang('crud.common.back')</span>
                    </a>
                    @lang('crud.all_employees.show_title')
                </x-slot>

                <div class="mt-4 px-4">
                    {{-- Usuário --}}
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_employees.inputs.user_id')
                        </h5>
                        <span>{{ optional($employees->user)->name ?? '-' }}</span>
                    </div>

                    {{-- Cargo --}}
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_employees.inputs.position')
                        </h5>
                        <span>
                            @php
                                // Se existir tradução em lang/enums.php, usa; senão, mostra ucfirst
                                $pos = $employees->position ?? null;
                                $label = $pos ? trans('enums.employees.position.' . $pos) : null;
                            @endphp
                            {{ $label !== 'enums.employees.position.' . $pos ? $label : ($pos ? ucfirst($pos) : '-') }}
                        </span>
                    </div>

                    {{-- Salário --}}
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_employees.inputs.salary')
                        </h5>
                        <span>
                            @if(!is_null($employees->salary))
                                R$ {{ number_format((float)$employees->salary, 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </span>
                    </div>

                    {{-- Data de Admissão (dd/mm/aaaa) --}}
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.all_employees.inputs.hired_date')
                        </h5>
                        <span>
                            {{ optional($employees->hired_date)->format('d/m/Y') ?? '-' }}
                        </span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('all-employees.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Employees::class)
                        <a href="{{ route('all-employees.create') }}" class="button button-primary">
                            <i class="mr-1 icon ion-md-add"></i>
                            @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
