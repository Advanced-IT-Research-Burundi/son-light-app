<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentStoreRequest extends FormRequest
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
            'invoice_id' => ['required', 'integer', 'exists:orders,id'],
            // 'order_id' => ['required', 'integer', 'exists:orders,id'],
            // 'user_id' => ['required', 'integer', 'exists:users,id'],
            'amount' => ['required', 'numeric'],
            'payment_date' => ['required', 'date'],
            'payment_method' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
