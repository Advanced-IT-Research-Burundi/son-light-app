<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentUpdateRequest extends FormRequest
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
            ///'amount' => ['required', 'DECIMAL(15, 2)'],
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/|max:1000000000000',
            'payment_date' => ['required', 'date'],
            'payment_method' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
