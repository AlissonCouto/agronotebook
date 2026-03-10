<div class="grid grid-cols-1 md:grid-cols-2 gap-6">


    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Nome
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $field->name ?? '') }}"
            class="w-full border rounded-lg px-3 py-2 @error('name') border-red-500 @enderror" />

        @error('name')
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
        @enderror

    </div>

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Área (ha)
        </label>

        <input
            type="number"
            step="0.01"
            name="area"
            value="{{ old('area', $field->area ?? '') }}"
            class="w-full border rounded-lg px-3 py-2 @error('area') border-red-500 @enderror" />

        @error('area')
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
        @enderror

    </div>


</div>

<div>


    <label class="block text-sm font-medium text-gray-700 mb-1">
        Fazenda
    </label>

    <select
        name="farm_id"
        class="w-full border rounded-lg px-3 py-2 @error('farm_id') border-red-500 @enderror">
        <option value="">Selecionar fazenda...</option>
        @foreach($farms as $farm)

        <option
            value="{{ $farm->id }}"
            {{ old('farm_id', $field->farm_id ?? '') == $farm->id ? 'selected' : '' }}>

            {{ $farm->name }}

        </option>

        @endforeach

    </select>

    @error('farm_id')
    <p class="text-red-500 text-xs mt-1">
        {{ $message }}
    </p>
    @enderror


</div>