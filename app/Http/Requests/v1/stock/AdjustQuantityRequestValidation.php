<?php

namespace App\Http\Requests\v1\stock;

use Illuminate\Foundation\Http\FormRequest;

class AdjustQuantityRequestValidation extends FormRequest
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
            'adjustment' => 'required|integer ',
        ];
    }
    public function messages(): array
    {
        return [
            'adjustment.required' => 'Adjustment is required',
            'adjustment.integer' => 'Adjustment must be an integer',
        ];
    }
}
