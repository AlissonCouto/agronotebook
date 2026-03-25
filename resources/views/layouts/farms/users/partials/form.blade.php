@php
$isEdit = isset($user);
$currentRole = old('role', $pivotRole ?? null);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Email do Usuário
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email', $user->email ?? '') }}"
            placeholder="usuario@email.com"
            class="w-full border rounded-lg px-3 py-2 {{ $isEdit ? 'bg-gray-100 cursor-not-allowed' : '' }} @error('email') border-red-500 @enderror"
            {{ $isEdit ? 'readonly' : '' }} />

        @error('email')
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
        @enderror

    </div>

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Papel na Fazenda
        </label>

        <select
            name="role"
            class="w-full border rounded-lg px-3 py-2 @error('role') border-red-500 @enderror">

            <option value="">Selecione</option>

            <option value="OWNER" {{ $currentRole == 'OWNER' ? 'selected' : '' }}>
                Proprietário
            </option>

            <option value="AGRONOMIST" {{ $currentRole == 'AGRONOMIST' ? 'selected' : '' }}>
                Agrônomo
            </option>

            <option value="EMPLOYEE" {{ $currentRole == 'EMPLOYEE' ? 'selected' : '' }}>
                Funcionário
            </option>

            <option value="VIEWER" {{ $currentRole == 'VIEWER' ? 'selected' : '' }}>
                Visualizador
            </option>

        </select>

        @error('role')
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
        @enderror

    </div>

</div>