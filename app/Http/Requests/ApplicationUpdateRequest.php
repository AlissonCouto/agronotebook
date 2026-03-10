<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'application_date' => ['required', 'date'],
            'dose' => ['required', 'numeric'],
            'unit' => ['required'],
            'area_applied' => ['required', 'numeric'],
            'application_type' => ['required'],
            'responsible_technician' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'product_id' => ['required', 'exists:products,id'],
            'field_id' => ['required', 'exists:fields,id'],
            'crop_id' => ['required', 'exists:crops,id'],
        ];
    }
}
