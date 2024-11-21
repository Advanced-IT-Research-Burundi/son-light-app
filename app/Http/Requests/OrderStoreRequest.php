<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'proforma_invoice_id' => ['required'],
            'amount' => ['required','numeric'],
            'quantity' => ['required','numeric'],
            'status_livraison'=>['required','integer'],
            'order_date' => ['required', 'date'],
            'delivery_date' => ['required', 'date'],
            'designation' => ['required', 'string'],
            'status' => ['required', 'string'],
            'price_letter'=>['nullable','string'],
            'description' => ['nullable', 'string'],
            'company_id' => 'required|exists:companies,id',
        ];
    }
}
