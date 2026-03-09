<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Nome
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $product->name ?? '') }}"
            class="w-full border rounded-lg px-3 py-2 @error('name') border-red-500 @enderror" />

        @error('name')
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
        @enderror

    </div>


    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Fabricante
        </label>

        <select
            name="manufacturer_id"
            class="w-full border rounded-lg px-3 py-2 @error('manufacturer_id') border-red-500 @enderror">

            <option value="">Selecione</option>

            @foreach($manufacturers as $manufacturer)

            <option
                value="{{ $manufacturer->id }}"
                {{ old('manufacturer_id', $product->manufacturer_id ?? '') == $manufacturer->id ? 'selected' : '' }}>

                {{ $manufacturer->name }}

            </option>

            @endforeach

        </select>

        @error('manufacturer_id')
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
        @enderror

    </div>

</div>

<div>

    <label class="block text-sm font-medium text-gray-700 mb-2">
        Princípios ativos
    </label>

    <select
        name="active_ingredients_id[]"
        multiple
        placeholder="Buscar princípio ativo..."
        class="tom-select w-full @error('active_ingredients_id.*') border-red-500 @enderror">

        @foreach($activeIngredients as $ai)

        <option
            value="{{ $ai->id }}"

            {{ collect(
            old(
                'active_ingredients_id',
                isset($product)
                    ? $product->activeIngredients->pluck('id')->toArray()
                    : []
            )
        )->contains($ai->id) ? 'selected' : '' }}>

            {{ $ai->name }}

        </option>

        @endforeach

    </select>

    @error('active_ingredients_id.*')
    <p class="text-red-500 text-xs mt-1">
        {{ $message }}
    </p>
    @enderror

</div>