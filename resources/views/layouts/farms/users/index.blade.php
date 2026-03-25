@php
$direction = request('direction') === 'asc' ? 'desc' : 'asc';
@endphp

@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-sm border w-full">

    <div class="p-6 border-b flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Usuários da Fazenda
            </h2>

            <p class="text-sm text-gray-500">
                {{ $farm->name }}
            </p>
        </div>

        <div class="flex items-center gap-3">
            <form
                method="GET"
                action="{{ route('farms.users', $farm->id) }}"
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
                href="{{ route('farms.users.create', $farm->id) }}"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm">

                Novo Usuário

            </a>
        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-50 text-gray-600">
                <tr>

                    <th class="px-6 py-3 text-left">
                        <a href="{{ route('farms.users', $farm->id) }}?sort=users.id&direction={{ $direction }}">
                            ID
                        </a>
                    </th>

                    <th class="px-6 py-3 text-left">
                        <a href="{{ route('farms.users', $farm->id) }}?sort=users.name&direction={{ $direction }}">
                            Nome
                        </a>
                    </th>

                    <th class="px-6 py-3 text-left">
                        <a href="{{ route('farms.users', $farm->id) }}?sort=users.email&direction={{ $direction }}">
                            Email
                        </a>
                    </th>

                    <th class="px-6 py-3 text-left">
                        Role (Sistema)
                    </th>

                    <th class="px-6 py-3 text-left">
                        Role (Fazenda)
                    </th>

                    <th class="px-6 py-3 text-left">
                        Ações
                    </th>

                </tr>
            </thead>

            <tbody>

                @forelse($users as $user)

                <tr class="border-t hover:bg-gray-50">

                    <td class="px-6 py-3">
                        {{ $user->id }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $user->name }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $user->email }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $user->role }}
                    </td>

                    <td class="px-6 py-3">
                        {{ $user->pivot_role }}
                    </td>

                    <td class="px-6 py-3">
                        <!-- depois você coloca remover / editar role -->
                        -
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                        Nenhum usuário encontrado
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="p-6 border-t">
        {{ $users->links() }}
    </div>

</div>

@endsection