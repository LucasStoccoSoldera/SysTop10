<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PacoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomePacotes' => ['required', 'string'],
            'descricaoPacotes' => ['required', 'string'],
        ];
    }

    public function message()
    {
        return [
            'nomePacotes.required' => 'Pacote obrigatório.',
            'descricaoPacotes.required' => 'Dimensão obrigatória.',
        ];
    }

}
