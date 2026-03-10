@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-sm border w-full">

    <div class="p-6 border-b flex justify-between items-center">

        <h2 class="text-lg font-semibold text-gray-800">
            Talhões
        </h2>

        <a
            href="{{ route('fields.create') }}"
            class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm">

            Novo Talhão

        </a>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">

                <tr>

                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Nome</th>
                    <th class="px-6 py-3 text-left">Área</th>
                    <th class="px-6 py-3 text-left">Fazenda</th>
                    <th class="px-6 py-3 text-left">Ações</th>

                </tr>

            </thead>

            <tbody>

                @forelse($fields as $field)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-6 py-3">{{ $field->id }}</td>
                    <td class="px-6 py-3">{{ $field->name }}</td>
                    <td class="px-6 py-3">{{ $field->area }} ha</td>
                    <td class="px-6 py-3">{{ $field->farm->name }}</td>

                    <td class="px-6 py-3 flex gap-3">

                        <a
                            href="{{ route('fields.edit', $field->id) }}"
                            class="text-blue-600 text-xs hover:underline">

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

                            <button class="text-red-600 hover:text-red-800">
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