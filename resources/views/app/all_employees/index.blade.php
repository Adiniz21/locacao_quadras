<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.all_employees.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                {{-- Filtros / Busca --}}
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between gap-3">
                        <div class="md:flex-1">
                            <form method="GET" action="{{ route('all-employees.index') }}" class="flex flex-wrap items-center gap-2">
                                <x-inputs.text
                                    name="search"
                                    :placeholder="__('crud.common.search')"
                                    value="{{ request('search', $search ?? '') }}"
                                    autocomplete="off"
                                    aria-label="{{ __('crud.common.search') }}"
                                    class="w-full md:w-auto"
                                />

                                <x-inputs.text
                                    name="position"
                                    :placeholder="__('crud.all_employees.inputs.position')"
                                    value="{{ request('position') }}"
                                    autocomplete="off"
                                    aria-label="@lang('crud.all_employees.inputs.position')"
                                    class="w-full md:w-auto"
                                />

                                {{-- Data (de) - use dd/mm/aaaa --}}
                                <x-inputs.date
                                    name="hired_from"
                                    :placeholder="__('crud.all_employees.inputs.hired_date') . ' (de)'"
                                    value="{{ request('hired_from') }}"
                                    aria-label="@lang('crud.all_employees.inputs.hired_date') (de)"
                                />

                                {{-- Data (até) - use dd/mm/aaaa --}}
                                <x-inputs.date
                                    name="hired_to"
                                    :placeholder="__('crud.all_employees.inputs.hired_date') . ' (até)'"
                                    value="{{ request('hired_to') }}"
                                    aria-label="@lang('crud.all_employees.inputs.hired_date') (até)"
                                />

                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                <input type="hidden" name="dir" value="{{ request('dir','asc') }}">

                                <button type="submit" class="button button-primary" title="{{ __('crud.common.search') }}">
                                    <i class="icon ion-md-search"></i>
                                    <span class="sr-only">{{ __('crud.common.search') }}</span>
                                </button>

                                @if(request()->hasAny(['search','position','hired_from','hired_to','sort','dir']))
                                    <a href="{{ route('all-employees.index') }}" class="button" title="@lang('crud.common.clear')">
                                        <i class="icon ion-md-close"></i>
                                        <span class="sr-only">@lang('crud.common.clear')</span>
                                    </a>
                                @endif
                            </form>
                        </div>

                        <div class="md:text-right">
                            @can('create', App\Models\Employees::class)
                                <a href="{{ route('all-employees.create') }}" class="button button-primary">
                                    <i class="mr-1 icon ion-md-add"></i>
                                    @lang('crud.common.create')
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>

                {{-- Tabela --}}
                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                @php
                                    $sort = request('sort'); $dir = request('dir','asc');
                                    $next = $dir === 'asc' ? 'desc' : 'asc';
                                    $link = fn($field) => request()->fullUrlWithQuery([
                                        'sort' => $field,
                                        'dir'  => $sort === $field ? $next : 'asc'
                                    ]);
                                    $chevron = function($active, $dir) {
                                        if(!$active) return '';
                                        $up = $dir==='asc';
                                        return $up
                                            ? '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 12.21a.75.75 0 001.06.02L10 8.69l3.71 3.54a.75.75 0 101.04-1.08l-4.23-4.04a.75.75 0 00-1.04 0L5.21 11.15a.75.75 0 00.02 1.06z"/></svg>'
                                            : '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline" viewBox="0 0 20 20" fill="currentColor"><path d="M14.77 7.79a.75.75 0 00-1.06-.02L10 11.31 6.29 7.77a.75.75 0 10-1.04 1.08l4.23 4.04a.75.75 0 001.04 0l4.23-4.04a.75.75 0 00.02-1.06z"/></svg>';
                                    };
                                @endphp

                                <th class="px-4 py-3 text-left" scope="col">
                                    <a href="{{ $link('user') }}" class="inline-flex items-center gap-1">
                                        @lang('crud.all_employees.inputs.user_id')
                                        {!! $chevron($sort==='user', $dir) !!}
                                    </a>
                                </th>
                                <th class="px-4 py-3 text-left" scope="col">
                                    <a href="{{ $link('position') }}" class="inline-flex items-center gap-1">
                                        @lang('crud.all_employees.inputs.position')
                                        {!! $chevron($sort==='position', $dir) !!}
                                    </a>
                                </th>
                                <th class="px-4 py-3 text-right" scope="col">
                                    <a href="{{ $link('salary') }}" class="inline-flex items-center gap-1">
                                        @lang('crud.all_employees.inputs.salary')
                                        {!! $chevron($sort==='salary', $dir) !!}
                                    </a>
                                </th>
                                <th class="px-4 py-3 text-left" scope="col">
                                    <a href="{{ $link('hired_date') }}" class="inline-flex items-center gap-1">
                                        @lang('crud.all_employees.inputs.hired_date')
                                        {!! $chevron($sort==='hired_date', $dir) !!}
                                    </a>
                                </th>
                                <th scope="col" class="px-4 py-3 text-center">@lang('crud.common.actions')</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-600">
                            @forelse($allEmployees as $employees)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-left">
                                        {{ optional($employees->user)->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ $employees->position ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        @if(!is_null($employees->salary))
                                            R$ {{ number_format($employees->salary, 2, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-left">
                                        {{ optional($employees->hired_date)->format('d/m/Y') ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-center" style="width: 160px;">
                                        @canany(['view','update','delete'], $employees)
                                            <div role="group" aria-label="@lang('crud.common.row_actions')" class="relative inline-flex align-middle">
                                                @can('update', $employees)
                                                    <a href="{{ route('all-employees.edit', $employees) }}" class="mr-1" title="@lang('crud.common.edit')">
                                                        <button type="button" class="button">
                                                            <i class="icon ion-md-create"></i>
                                                            <span class="sr-only">@lang('crud.common.edit')</span>
                                                        </button>
                                                    </a>
                                                @endcan
                                                @can('view', $employees)
                                                    <a href="{{ route('all-employees.show', $employees) }}" class="mr-1" title="@lang('crud.common.show')">
                                                        <button type="button" class="button">
                                                            <i class="icon ion-md-eye"></i>
                                                            <span class="sr-only">@lang('crud.common.show')</span>
                                                        </button>
                                                    </a>
                                                @endcan
                                                @can('delete', $employees)
                                                    <form
                                                        action="{{ route('all-employees.destroy', $employees) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                                    >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="button" title="@lang('crud.common.delete')">
                                                            <i class="icon ion-md-trash text-red-600"></i>
                                                            <span class="sr-only">@lang('crud.common.delete')</span>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        @endcanany
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                        @lang('crud.common.no_items_found')
                                        @can('create', App\Models\Employees::class)
                                            <div class="mt-3">
                                                <a href="{{ route('all-employees.create') }}" class="button button-primary">
                                                    <i class="mr-1 icon ion-md-add"></i>
                                                    @lang('crud.common.create')
                                                </a>
                                            </div>
                                        @endcan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="mt-6 px-4 flex items-center justify-between">
                                        <div class="text-sm text-gray-500">
                                            @php
                                                $from = $allEmployees->firstItem() ?? 0;
                                                $to   = $allEmployees->lastItem() ?? 0;
                                                $total = $allEmployees->total();
                                            @endphp
                                            {{ "Mostrando {$from}-{$to} de {$total}" }}
                                        </div>
                                        <div>
                                            {!! $allEmployees->onEachSide(1)->links() !!}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
