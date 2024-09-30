<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialUsageUpdateRequest extends FormRequest
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
            'stock_id' => ['required', 'integer', 'exists:stocks,id'],
            'task_id' => ['required', 'integer', 'exists:tasks,id'],
            // 'user_id' => ['required', 'integer', 'exists:users,id'],
            'quantity_used' => ['required', 'integer'],
            'usage_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
        ];
    }
}
