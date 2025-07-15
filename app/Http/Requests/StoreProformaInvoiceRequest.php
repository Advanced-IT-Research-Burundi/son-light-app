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
            'amount_ht' => 'min:0',
            'amount_tvac' => 'min:0',
            'tva' => 'numeric|min:0',
            'price_letter' => $this->priceLetterRules(),
            'designation' => $this->designationRules(),
            'quantity' => $this->quantityRules(),
            'validity_period' => $this->validityPeriodRules(),
            'company_id' => $this->companyIdRules(),
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
     private function quantityRules(): array
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
      private function designationRules(): array
    {
        return ['required', 'string', 'max:255']; 
    }

    private function companyIdRules(): array
    {
        return ['required', 'integer', 'exists:companies,id'];
    }
    public function messages(): array
    {
        return [
            'client_id.required' => 'Le champ client est obligatoire.',
            'designation.required' => 'Le champ designation est obligatoire.',
            'quantity.required' => 'La quantité est requise.',
             'amount.required' => 'Le montant est requis.',
            'invoice_number.unique' => 'Ce numéro de facture proforma existe déjà.',
            'proforma_invoice_date.date' => 'La date de la facture proforma doit être une date valide.',
            'validity_period.required' => 'La période de validité est requise.',
            'company_id.required' => 'L\'ID de l\'entreprise est requis.',
        ];
    }
}
