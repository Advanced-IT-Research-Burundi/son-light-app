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
            'proforma_invoice_id' => ['required', 'exists:proforma_invoices,id'], // Validation pour l'existence
            'amount' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric'],
            'status_livraison' => ['required', 'boolean'], // Doit être un booléen
            'order_date' => ['nullable', 'date'],
            'delivery_date' => ['nullable', 'date'],
            'designation' => ['required', 'string'],
            'status' => ['required', 'string'],
            'price_letter' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'company_id' => ['required', 'exists:companies,id'],
            'tc' => ['nullable', 'numeric'],
            'atax' => ['nullable', 'numeric'],
            'pf' => ['nullable', 'numeric'],
            'tva' => ['nullable', 'numeric'],
            'amount_ht' => ['nullable', 'numeric'],
            'amount_ttc' => ['nullable', 'numeric'],
        ];
    }

    /**
     * Get the validation error messages.
     */
    public function messages(): array
    {
        return [
            'client_id.required' => 'Le champ client est requis.',
            'client_id.integer' => 'Le client doit être un identifiant valide.',
            'client_id.exists' => 'Le client sélectionné n\'existe pas.',
            'proforma_invoice_id.required' => 'Le champ facture pro forma est requis.',
            'proforma_invoice_id.exists' => 'La facture pro forma sélectionnée n\'existe pas.', // Message d'erreur ajouté
            'amount.required' => 'Le montant est requis.',
            'amount.numeric' => 'Le montant doit être un nombre.',
            'quantity.required' => 'La quantité est requise.',
            'quantity.numeric' => 'La quantité doit être un nombre.',
            'status_livraison.required' => 'Le statut de livraison est requis.',
            'status_livraison.boolean' => 'Le statut de livraison doit être vrai ou faux.', // Modifié pour boolean
            'order_date.required' => 'La date de commande est requise.',
            'order_date.date' => 'La date de commande doit être une date valide.',
            'delivery_date.required' => 'La date de livraison est requise.',
            'delivery_date.date' => 'La date de livraison doit être une date valide.',
            'designation.required' => 'La désignation est requise.',
            'designation.string' => 'La désignation doit être une chaîne de caractères.',
            'status.required' => 'Le statut est requis.',
            'status.string' => 'Le statut doit être une chaîne de caractères.',
            'price_letter.string' => 'Le prix en lettres doit être une chaîne de caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'company_id.required' => 'Le champ entreprise est requis.',
            'company_id.exists' => 'L\'entreprise sélectionnée n\'existe pas.',
            'tc.numeric' => 'Le champ TC doit être un nombre.',
            'atax.numeric' => 'Le champ A.TAX doit être un nombre.',
            'pf.numeric' => 'Le champ PF doit être un nombre.',
            'tva.numeric' => 'La TVA doit être un nombre.',
            'amount_ht.numeric' => 'Le montant HT doit être un nombre.',
            'amount_ttc.numeric' => 'Le montant TTC doit être un nombre.',
        ];
    }
}
