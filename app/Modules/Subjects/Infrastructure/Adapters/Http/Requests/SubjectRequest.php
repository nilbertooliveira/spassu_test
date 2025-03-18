<?php

namespace App\Modules\Subjects\Infrastructure\Adapters\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'description' => 'required|string|max:20',
        ];

    }

    public function messages(): array
    {
        return [
            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'O campo descrição deve ser um texto.',
            'description.max' => 'A descrição não pode ter mais que 20 caracteres.',
        ];

    }
}
