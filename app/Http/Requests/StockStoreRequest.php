<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string'],
            'code' => ['nullable', 'string'],
            'quantity' => ['required', 'integer'],
            'unit' => ['required', 'string'],
            'min_quantity' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
            'last_restock_date' => ['nullable', 'date'],
        ];
    }
}
