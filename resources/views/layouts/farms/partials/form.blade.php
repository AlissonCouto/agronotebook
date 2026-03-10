<div class="grid grid-cols-1 md:grid-cols-2 gap-6">


    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Nome
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $farm->name ?? '') }}"
            class="w-full border rounded-lg px-3 py-2 @error('name') border-red-500 @enderror" />

        @error('name')
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
        @enderror

    </div>

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Área total (ha)
        </label>

        <input
            type="number"
            step="0.01"
            name="total_area"
            value="{{ old('total_area', $farm->total_area ?? '') }}"
            class="w-full border rounded-lg px-3 py-2 @error('total_area') border-red-500 @enderror" />

        @error('total_area')
        <p class="text-red-500 text-xs mt-1">
            {{ $message }}
        </p>
        @enderror

    </div>


</div>

<div>


    <label class="block text-sm font-medium text-gray-700 mb-1">
        Localização
    </label>

    <input
        type="text"
        name="location"
        value="{{ old('location', $farm->location ?? '') }}"
        class="w-full border rounded-lg px-3 py-2 @error('location') border-red-500 @enderror" />

    @error('location')
    <p class="text-red-500 text-xs mt-1">
        {{ $message }}
    </p>
    @enderror


</div>

<div>


    <label class="block text-sm font-medium text-gray-700 mb-1">
        Descrição
    </label>

    <textarea
        name="description"
        class="w-full border rounded-lg px-3 py-2 @error('description') border-red-500 @enderror"
        rows="3">{{ old('description', $farm->description ?? '') }}</textarea>

    @error('description')
    <p class="text-red-500 text-xs mt-1">
        {{ $message }}
    </p>
    @enderror


</div>