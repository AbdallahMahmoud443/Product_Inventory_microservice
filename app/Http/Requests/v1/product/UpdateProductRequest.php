<?php

namespace App\Http\Requests\v1\product;

use App\Enums\ProductStatusEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'sku' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0', 'max:999999.99'],
            'stock_quantity' => ['sometimes', 'required', 'numeric', 'min:0', 'max:999999.99'],
            'low_stock_threshold' => ['sometimes', 'integer', 'min:0'],
            'status' => ['sometimes', 'required', Rule::in(ProductStatusEnums::values())],
        ];
    }
    /**
     * Get custom messages for validator errors.
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price cannot be negative',
            'sku.required' => 'SKU is required',
            'sku.unique' => 'SKU already exists',
            'stock_quantity.required' => 'Stock quantity is required',
            'stock_quantity.numeric' => 'Stock quantity must be a number',
            'stock_quantity.min' => 'Stock quantity cannot be negative',
            'status.required' => 'Status is required',
            'status.in' => 'Invalid status value',
        ];
    }
}
