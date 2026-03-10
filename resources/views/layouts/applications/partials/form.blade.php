<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Data da aplicação
        </label>

        <input
            type="datetime-local"
            name="application_date"
            value="{{ old('application_date', isset($application) ? $application->application_date->format('Y-m-d\TH:i') : '') }}"
            class="w-full border rounded-lg px-3 py-2" />

    </div>

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Tipo de aplicação
        </label>

        <select
            name="application_type"
            class="w-full border rounded-lg px-3 py-2">

            @foreach(\App\Enums\ApplicationType::cases() as $type)

            <option
                value="{{ $type->value }}"
                {{ old('application_type', $application->application_type ?? '') == $type->value ? 'selected' : '' }}>

                {{ $type->label() }}

            </option>

            @endforeach

        </select>

    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Produto
        </label>

        <select
            name="product_id"
            class="w-full border rounded-lg px-3 py-2">

            @foreach($products as $product)

            <option
                value="{{ $product->id }}"
                {{ old('product_id', $application->product_id ?? '') == $product->id ? 'selected' : '' }}>

                {{ $product->name }}

            </option>

            @endforeach

        </select>

    </div>

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Talhão
        </label>

        <select
            name="field_id"
            class="w-full border rounded-lg px-3 py-2">

            @foreach($fields as $field)

            <option
                value="{{ $field->id }}"
                {{ old('field_id', $application->field_id ?? '') == $field->id ? 'selected' : '' }}>

                {{ $field->name }}

            </option>

            @endforeach

        </select>

    </div>

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Cultura
        </label>

        <select
            name="crop_id"
            class="w-full border rounded-lg px-3 py-2">

            @foreach($crops as $crop)

            <option
                value="{{ $crop->id }}"
                {{ old('crop_id', $application->crop_id ?? '') == $crop->id ? 'selected' : '' }}>

                {{ $crop->name }}

            </option>

            @endforeach

        </select>

    </div>

</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Dose
        </label>

        <input
            type="number"
            step="0.01"
            name="dose"
            value="{{ old('dose', $application->dose ?? '') }}"
            class="w-full border rounded-lg px-3 py-2" />

    </div>

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Unidade
        </label>

        <select
            name="unit"
            class="w-full border rounded-lg px-3 py-2">

            @foreach(\App\Enums\DoseUnit::cases() as $unit)

            <option
                value="{{ $unit->value }}"
                {{ old('unit', $application->unit ?? '') == $unit->value ? 'selected' : '' }}>

                {{ $unit->label() }}

            </option>

            @endforeach

        </select>

    </div>

    <div>

        <label class="block text-sm font-medium text-gray-700 mb-1">
            Área aplicada (ha)
        </label>

        <input
            type="number"
            step="0.01"
            name="area_applied"
            value="{{ old('area_applied', $application->area_applied ?? '') }}"
            class="w-full border rounded-lg px-3 py-2" />

    </div>

</div>

<div>

    <label class="block text-sm font-medium text-gray-700 mb-1">
        Responsável técnico
    </label>

    <input
        type="text"
        name="responsible_technician"
        value="{{ old('responsible_technician', $application->responsible_technician ?? '') }}"
        class="w-full border rounded-lg px-3 py-2" />

</div>

<div>

    <label class="block text-sm font-medium text-gray-700 mb-1">
        Observações
    </label>

    <textarea
        name="notes"
        rows="3"
        class="w-full border rounded-lg px-3 py-2">{{ old('notes', $application->notes ?? '') }}</textarea>

</div>