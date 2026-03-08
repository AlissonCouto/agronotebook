@extends('layouts.app')
<?php
$p = new stdClass();
$p->id = 1;
$p->name = "Produto Teste";
$p->ingredients = "2D, Acidos";
$p->manufacturer = "Bayer";

$products = [
    $p
];
?>
@section('content')

<div class="bg-white p-6 rounded shadow">

    <div class="flex justify-between mb-6">

        <input
            type="text"
            placeholder="Buscar produto..."
            class="border rounded px-4 py-2 w-64" />

        <a
            href="/products/create"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">

            Novo </a>

    </div>

    <table class="w-full text-sm">

        <thead class="bg-gray-50 text-gray-600">

            <tr>

                <th class="text-left px-6 py-3">ID</th>
                <th class="text-left px-6 py-3">Nome</th>
                <th class="text-left px-6 py-3">Princípio ativo</th>
                <th class="text-left px-6 py-3">Fabricante</th>
                <th class="text-left px-6 py-3">Ações</th>

            </tr>

        </thead>

        <tbody>

            @foreach($products as $product)

            <tr class="border-t hover:bg-gray-50">

                <td class="px-6 py-3">{{ $product->id }}</td>
                <td class="px-6 py-3">{{ $product->name }}</td>
                <td class="px-6 py-3">{{ $product->ingredients }}</td>
                <td class="px-6 py-3">{{ $product->manufacturer }}</td>

                <td class="px-6 py-3 flex gap-2">

                    <a
                        href="/products/{{ $product->id }}/edit"
                        class="bg-yellow-500 text-white px-3 py-1 rounded text-xs">

                        Editar </a>

                    <form method="POST" action="/products/{{ $product->id }}">
                        @csrf
                        @method('DELETE')

                        <button
                            class="bg-red-500 text-white px-3 py-1 rounded text-xs">

                            Excluir </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection