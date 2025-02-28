<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProformaInvoiceRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     */
    public function authorize(): bool
    {
        return true; // Mettez à jour cette logique pour vérifier les autorisations de l'utilisateur si nécessaire.
    }

    /**
     * Obtenir les règles de validation qui s'appliquent à la requête.
     */
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
        ];
    }

    private function clientIdRules(): array
    {
        return ['required', 'integer', 'exists:clients,id'];
    }

    private function amountRules(): array
    {
        return ['required', 'numeric', 'min:0']; // Assurer que le montant est positif
    }

    private function invoiceNumberRules(): array
    {
        return ['nullable', 'string', 'unique:proforma_invoices,invoice_number', 'max:255']; // Limiter la longueur et s'assurer que chaque numéro de facture pro forma est unique
    }

    private function dateRules(string $attribute): array
    {
        return ['nullable', 'date', 'date_format:Y-m-d']; // Assurer le format de la date
    }

    private function unitRules(): array
    {
        return ['nullable', 'string', 'max:50']; // Limiter la longueur de l'unité
    }

    private function priceLetterRules(): array
    {
        return ['nullable', 'string', 'max:255']; // Limiter la longueur
    }

    private function validityPeriodRules(): array
    {
        return ['required', 'integer', 'min:1']; // Assurer que le période de validité est positive
    }

    private function companyIdRules(): array
    {
        return ['required', 'integer', 'exists:companies,id'];
    }

    /**
     * Configure les messages d'erreur personnalisés pour les règles de validation.
     */
    public function messages(): array
    {
        return [
            'client_id.required' => 'Le champ client est obligatoire.',
            'amount.required' => 'Le montant est requis.',
            'invoice_number.unique' => 'Ce numéro de facture pro forma existe déjà.',
            'proforma_invoice_date.date' => 'La date de la facture pro forma doit être une date valide.',
            'validity_period.required' => 'La période de validité est requise.',
            'company_id.required' => 'L\'ID de l\'entreprise est requis.',
        ];
    }
}
