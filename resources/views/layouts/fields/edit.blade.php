@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-sm border w-full">

    <div class="p-6 border-b">
        <h2 class="text-lg font-semibold text-gray-800">
            Editar Talhão
        </h2>
    </div>

    <form
        method="POST"
        action="{{ route('fields.update', $field->id) }}"
        class="p-6 space-y-6">

        @csrf
        @method('PUT')

        @include('layouts.fields.partials.form')

        <div class="flex justify-end gap-3 pt-4">

            <a
                href="{{ route('fields.index') }}"
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