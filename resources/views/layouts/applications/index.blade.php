@php
$direction = request('direction') === 'asc' ? 'desc' : 'asc';
@endphp

@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-sm border w-full">

    <div class="p-6 border-b flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <h2 class="text-lg font-semibold text-gray-800">
            Aplicações
        </h2>

        <div class="flex items-center gap-3">

            <form
                method="GET"
                action="{{ route('applications.index') }}"
                x-data="{ timer: null }"
                class="flex">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Buscar..."
                    @input="
                clearTimeout(timer);
                timer = setTimeout(() => $el.form.submit(), 500);
            "
                    class="border rounded-l-lg px-3 py-2 text-sm" />

                <button
                    type="submit"
                    class="border border-l-0 rounded-r-lg px-3 py-2 bg-gray-50 hover:bg-gray-100">

                    <i class="fas fa-search"></i>

                </button>

            </form>

            <a
                href="{{ route('applications.create') }}"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm">

                Nova Aplicação

            </a>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">

                <tr>

                    <th class="text-left px-6 py-3">
                        <a href="{{ route('applications.index', ['sort' => 'application_date', 'direction' => $direction] + request()->query()) }}">
                            Data
                        </a>
                    </th>

                    <th class="text-left px-6 py-3">
                        Produto
                    </th>

                    <th class="text-left px-6 py-3">
                        Dose
                    </th>

                    <th class="text-left px-6 py-3">
                        Talhão
                    </th>

                    <th class="text-left px-6 py-3">
                        Cultura
                    </th>

                    <th class="text-left px-6 py-3">
                        Ações
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($applications as $application)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-6 py-3">
                        {{ $application->application_date->format('d/m/Y') }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $application->product->name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $application->dose }} {{ $application->unit }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $application->field->name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $application->crop->name }}
                    </td>

                    <td class="px-6 py-3 flex items-center gap-3">

                        <a
                            href="{{ route('applications.edit', $application->id) }}"
                            class="text-blue-600 hover:underline text-xs">

                            Editar

                        </a>

                        <form
                            method="POST"
                            action="{{ route('applications.destroy', $application->id) }}"
                            x-data
                            @submit.prevent="
                        Swal.fire({
                            title: 'Tem certeza?',
                            text: 'Essa aplicação será removida.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#dc2626',
                            cancelButtonColor: '#6b7280',
                            confirmButtonText: 'Sim, excluir',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $el.submit()
                            }
                        })
                    ">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-red-600 hover:text-red-800">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                        Nenhuma aplicação encontrada
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-6 border-t">

        {{ $applications->links() }}

    </div>

</div>

@endsection