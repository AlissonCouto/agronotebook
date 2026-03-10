@php
$direction = request('direction') === 'asc' ? 'desc' : 'asc';
@endphp

@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-sm border w-full">

    <div class="p-6 border-b flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <h2 class="text-lg font-semibold text-gray-800">
            Talhões
        </h2>

        <div class="flex items-center gap-3">

            <form
                method="GET"
                action="{{ route('fields.index') }}"
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
                href="{{ route('fields.create') }}"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm">

                Novo Talhão

            </a>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">

                <tr>

                    <th class="text-left px-6 py-3">
                        <a href="{{ route('fields.index', ['sort' => 'id', 'direction' => $direction] + request()->query()) }}">
                            ID
                        </a>
                    </th>

                    <th class="text-left px-6 py-3">
                        <a href="{{ route('fields.index', ['sort' => 'name', 'direction' => $direction] + request()->query()) }}">
                            Nome
                        </a>
                    </th>

                    <th class="text-left px-6 py-3">
                        <a href="{{ route('fields.index', ['sort' => 'area', 'direction' => $direction] + request()->query()) }}">
                            Área
                        </a>
                    </th>

                    <th class="text-left px-6 py-3">
                        Fazenda
                    </th>

                    <th class="text-left px-6 py-3">
                        Ações
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($fields as $field)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-6 py-3">
                        {{ $field->id }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $field->name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $field->area }} ha
                    </td>

                    <td class="px-6 py-3">
                        {{ $field->farm->name }}
                    </td>

                    <td class="px-6 py-3 flex items-center gap-3">

                        <a
                            href="{{ route('fields.edit', $field->id) }}"
                            class="text-blue-600 hover:underline text-xs">

                            Editar

                        </a>

                        <form
                            method="POST"
                            action="{{ route('fields.destroy', $field->id) }}"
                            x-data
                            @submit.prevent="
                        Swal.fire({
                            title: 'Tem certeza?',
                            text: 'Essa ação não poderá ser desfeita.',
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
                    <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                        Nenhum talhão encontrado
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-6 border-t">

        {{ $fields->links() }}

    </div>

</div>

@endsection