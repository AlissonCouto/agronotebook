@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-sm border w-full">

    <div class="p-6 border-b">
        <h2 class="text-lg font-semibold text-gray-800">
            Editar Usuário da Fazenda
        </h2>

        <p class="text-sm text-gray-500">
            {{ $farm->name }}
        </p>
    </div>

    <form method="POST" action="{{ route('farms.users.update', [$farm->id, $user->id]) }}" class="p-6 space-y-6">

        @csrf
        @method('PUT')

        @include('layouts.farms.users.partials.form', [
        'user' => $user,
        'pivotRole' => $user->pivot->role
        ])

        <div class="flex justify-end gap-3 pt-4">

            <a href="{{ route('farms.users', $farm->id) }}"
                class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-100">

                Voltar

            </a>

            <button
                type="submit"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2 rounded-lg">

                Atualizar

            </button>

        </div>

    </form>

</div>

@endsection