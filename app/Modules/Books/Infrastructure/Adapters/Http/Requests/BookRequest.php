<?php

namespace App\Modules\Books\Infrastructure\Adapters\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'title' => 'required|string|max:40',
            'publisher' => 'required|string|max:40',
            'edition' => 'required|integer|min:1|max:99999',
            'yearPublication' => 'required|digits:4|integer',
            'price' => 'required|numeric|min:0.01|max:99999',
            'authors' => 'required|array|min:1',
            'authors.*' => 'integer|exists:Autor,CodAu',
            'subjects' => 'required|array|min:1',
            'subjects.*' => 'integer|exists:Assunto,codAs',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo título é obrigatório.',
            'title.string' => 'O título deve ser um texto.',
            'title.max' => 'O título não pode ter mais que 40 caracteres.',

            'publisher.required' => 'O campo editora é obrigatório.',
            'publisher.string' => 'O campo editora deve ser um texto.',
            'publisher.max' => 'A editora não pode ter mais que 40 caracteres.',

            'edition.required' => 'O campo edição é obrigatório.',
            'edition.integer' => 'A edição deve ser um número inteiro.',
            'edition.min' => 'A edição deve ser pelo menos 1.',
            'edition.max' => 'A edição não pode ser maior que 99999.',

            'yearPublication.required' => 'O campo ano de publicação é obrigatório.',
            'yearPublication.digits' => 'O ano de publicação deve ter exatamente 4 dígitos.',
            'yearPublication.integer' => 'O ano de publicação deve ser um número inteiro.',

            'price.required' => 'O campo preço é obrigatório.',
            'price.numeric' => 'O preço deve ser um número.',
            'price.min' => 'O preço deve ser pelo menos R$ 0,01.',
            'price.max' => 'O preço não pode ser maior que R$ 99.999,00.',

            'authors.required' => 'Você deve selecionar pelo menos um autor.',
            'authors.array' => 'O campo autores deve ser um array válido.',
            'authors.*.integer' => 'O autor selecionado deve ser um identificador válido (número inteiro).',
            'authors.*.exists' => 'O autor selecionado não existe no banco de dados.',

            'subjects.required' => 'Você deve selecionar pelo menos um assunto.',
            'subjects.array' => 'O campo assuntos deve ser um array válido.',
            'subjects.*.integer' => 'O assunto selecionado deve ser um identificador válido (número inteiro).',
            'subjects.*.exists' => 'O assunto selecionado não existe no banco de dados.',
        ];
    }
}
