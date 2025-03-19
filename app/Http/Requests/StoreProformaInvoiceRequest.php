<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProformaInvoiceRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'client_id' => $this->clientIdRules(),
            'amount' => $this->amountRules(),
            'invoice_number' => $this->invoiceNumberRules(),
            'proforma_invoice_date' => $this->dateRules('proforma_invoice_date'),
            'unit' => $this->unitRules(),
            'price_letter' => $this->priceLetterRules(),
            'validity_period' => $this->validityPeriodRules(),
            'company_id' => $this->companyIdRules(),
            'tva' => $this->tvaRules(),
        ];
    }

    private function clientIdRules(): array
    {
        return ['required', 'integer', 'exists:clients,id'];
    }

    private function amountRules(): array
    {
        return ['required', 'numeric', 'min:0'];
    }

    private function invoiceNumberRules(): array
    {
        return ['nullable', 'string', 'unique:proforma_invoices,invoice_number', 'max:255'];
    }

    private function dateRules(string $attribute): array
    {
        return ['nullable', 'date', 'date_format:Y-m-d'];
    }

    private function unitRules(): array
    {
        return ['nullable', 'string', 'max:50'];
    }

    private function priceLetterRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    private function validityPeriodRules(): array
    {
        return ['required', 'integer', 'min:1'];
    }

    private function companyIdRules(): array
    {
        return ['required', 'integer', 'exists:companies,id'];
    }

    private function tvaRules(): array
    {
        return ['nullable', 'numeric', 'between:0,100'];
    }


    public function messages(): array
    {
        return [
            'client_id.required' => 'Le champ client est obligatoire.',
            'amount.required' => 'Le montant est requis.',
            'invoice_number.unique' => 'Ce numéro de facture pro forma existe déjà.',
            'proforma_invoice_date.date' => 'La date de la facture pro forma doit être une date valide.',
            'validity_period.required' => 'La période de validité est requise.',
            'company_id.required' => 'L\'ID de l\'entreprise est requis.',
            'tva.between' => 'La TVA doit être un nombre entre 0 et 100.',
        ];
    }
}
