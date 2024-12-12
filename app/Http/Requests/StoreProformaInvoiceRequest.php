<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProformaInvoiceRequest extends FormRequest
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
            'client_id' => ['required', 'integer', 'exists:clients,id'],
            'amount' => ['required', 'numeric'],
            'invoice_number'=>['nullable','string','unique:proforma_invoices,invoice_number'],
            'proforma_invoice_date'=>['nullable','string'],
            'unit'=>['nullable','string'],
            'price_letter'=>['nullable','string'],
            'validity_period' => ['required', 'integer'],
            'company_id' => 'required|exists:companies,id',
        ];
    }
}
