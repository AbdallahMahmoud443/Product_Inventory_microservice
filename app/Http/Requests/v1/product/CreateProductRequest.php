<?php

namespace App\Http\Requests\v1\product;

use App\Enums\ProductStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
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
            'sku' => ['required', 'string', 'unique:products,sku'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'stock_quantity' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'low_stock_threshold' => ['integer', 'min:0'],
            'status' => ['required', Rule::in([ProductStatus::ACTIVE, ProductStatus::INACTIVE, ProductStatus::DISCONTINUED])]
        ];
    }
    /**
     * Get custom messages for validator errors.
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'sku.required' => 'SKU is required',
            'sku.unique' => 'SKU already exists',
            'name.required' => 'Product name is required',
            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price cannot be negative',
            'stock_quantity.required' => 'Stock quantity is required',
            'stock_quantity.numeric' => 'Stock quantity must be a number',
            'stock_quantity.min' => 'Stock quantity cannot be negative',
            'status.required' => 'Status is required',
            'status.in' => 'Invalid status value',
        ];
    }
}
