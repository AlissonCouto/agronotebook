<div class="grid grid-cols-1 md:grid-cols-2 gap-6">


    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Nome
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $crop->name ?? '') }}"
            class="w-full border rounded-lg px-3 py-2 @error('name') border-red-500 @enderror" />

        @error('name')
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
        @enderror

    </div>

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Safra
        </label>

        <input
            type="number"
            name="harvest_year"
            value="{{ old('harvest_year', $crop->harvest_year ?? '') }}"
            class="w-full border rounded-lg px-3 py-2 @error('harvest_year') border-red-500 @enderror" />

        @error('harvest_year')
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
        @enderror

    </div>


</div>

<div>


    <label class="block text-sm font-medium text-gray-700 mb-1">
        Talhão
    </label>

    <select
        name="field_id"
        class="w-full border rounded-lg px-3 py-2 @error('field_id') border-red-500 @enderror">

        <option value="">Selecionar talhão...</option>

        @foreach($fields as $field)

        <option
            value="{{ $field->id }}"
            {{ old('field_id', $crop->field_id ?? '') == $field->id ? 'selected' : '' }}>

            {{ $field->name }}

        </option>

        @endforeach

    </select>

    @error('field_id')
    <p class="text-red-500 text-xs mt-1">
        {{ $message }}
    </p>
    @enderror


</div>