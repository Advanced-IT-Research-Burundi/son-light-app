<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
            'order_id' => ['required', 'integer', 'exists:orders,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ];
    }
}
