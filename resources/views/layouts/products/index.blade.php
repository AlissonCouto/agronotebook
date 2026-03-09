@php
$direction = request('direction') === 'asc' ? 'desc' : 'asc';
@endphp

@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-sm border w-full">

    <div class="p-6 border-b flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <h2 class="text-lg font-semibold text-gray-800">
            Produtos
        </h2>

        <div class="flex items-center gap-3">

            <form
                method="GET"
                action="{{ route('products.index') }}"
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
                href="{{ route('products.create') }}"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm">

                Novo

            </a>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">

                <tr>

                    <th class="text-left px-6 py-3">
                        <a href="{{ route('products.index', ['sort' => 'id', 'direction' => $direction] + request()->query()) }}">
                            ID
                        </a>
                    </th>

                    <th class="text-left px-6 py-3">
                        <a href="{{ route('products.index', ['sort' => 'name', 'direction' => $direction] + request()->query()) }}">
                            Nome
                        </a>
                    </th>

                    <th class="text-left px-6 py-3">
                        Princípio ativo
                    </th>

                    <th class="text-left px-6 py-3">
                        <a href="{{ route('products.index', ['sort' => 'manufacturer_id', 'direction' => $direction] + request()->query()) }}">
                            Fabricante
                        </a>
                    </th>

                    <th class="text-left px-6 py-3">
                        Ações
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($products as $product)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-6 py-3">
                        {{ $product->id }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $product->name }}
                    </td>

                    <td class="px-6 py-3">

                        <div class="flex flex-wrap gap-1">

                            @foreach($product->activeIngredients->take(3) as $ai)

                            <span class="bg-emerald-100 text-emerald-700 text-xs px-2 py-1 rounded">

                                {{ $ai->name }}

                            </span>

                            @endforeach

                            @if($product->activeIngredients->count() > 3)

                            <span class="text-xs text-gray-500 px-1">

                                +{{ $product->activeIngredients->count() - 3 }}

                            </span>

                            @endif

                        </div>

                    </td>

                    <td class="px-6 py-3">
                        {{ $product->manufacturer->name }}
                    </td>

                    <td class="px-6 py-3 flex items-center gap-3">

                        <a
                            href="{{ route('products.edit', $product->id) }}"
                            class="text-blue-600 hover:underline text-xs">

                            Editar

                        </a>

                        <form
                            method="POST"
                            action="{{ route('products.destroy', $product->id) }}"
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
                        Nenhum produto encontrado
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-6 border-t">

        {{ $products->links() }}

    </div>

</div>

@endsection