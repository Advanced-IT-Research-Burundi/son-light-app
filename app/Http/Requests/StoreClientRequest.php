<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:clients'],
            'phone' => ['required','string','max:255'],
            'address' => ['required','string','max:255'],
            'description' => ['nullable','string','max:255'],
            'company' => ['nullable','string','max:255'],
            'nif' => ['nullable','string','max:255'],

        ];
    }

}