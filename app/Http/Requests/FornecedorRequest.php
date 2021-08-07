<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\RuleTelefone;
use App\Rules\RuleCPF;
use App\Rules\RuleCEP;

class FornecedorRequest extends FormRequest
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
            'nomeFornecedor' => ['required', 'string'],
            'telefone' => ['required', 'string', 'celular'],
            'cpf' => ['required', 'string', 'cpf'],
            'cep' => ['required', 'string'],
            'cidadeFornecedor' => ['required', 'string'],
            'estadoFornecedor' => ['required', 'string'],
            'bairroFornecedor' => ['required', 'string'],
            'ruaFornecedor' => ['required', 'string'],
            'ncasaFornecedor' => ['required', 'digits:4'],
        ];
    }

    public function message()
    {
        return [
            'nomeFornecedor.required' => 'Nome obrigatório.',
            'telefone.required' => 'Telefone obrigatório.',
            'cpf.required' => 'CPF obrigatório.',
            'cep.required' => 'CEP obrigatório.',
            'telefone.telefone' => 'Telefone inválido.',
            'cpf.cpf' => 'CPF inválido.',
            'cep.cep' => 'CEP inváido.',
            'cidadeFornecedor.required' => 'Cidade obrigatória.',
            'estadoFornecedor.required' => 'Estado obrigatório.',
            'bairroFornecedor.required' => 'Bairro obrigatório.',
            'ruaFornecedor.required' => 'Rua obrigatória.',
            'ncasaFornecedor.required' => 'Número obrigatório.',
        ];
    }

}
