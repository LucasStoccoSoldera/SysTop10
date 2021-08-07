<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\RuleCPF;
use App\Rules\RuleTelefone;

class ClienteRequest extends FormRequest
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
            'nomeCliente' => ['required', 'string'],
            'usuarioCliente' => ['required'],
            'senhaCliente' => ['required', 'confirmed'],
            'cpf_cnpj' => ['required', 'digits:11', 'cpf'],
            'cpf_cnpj' => ['required', 'digits:14', 'cnpj'],
            'telefone' => ['required', 'telefone'],
            'celular' => ['required', 'celular'],
        ];
    }

    public function message()
    {

        return [
            'nomeCliente.required' => 'Nome completo obrigatório.',
            'usuarioCliente.required' => 'Usuário obrigatório.',
            'senhaCliente.required' => 'Senha obrigatório.',
            'senhaCliente.confirmed' => 'Confirmação de senha inválida.',
            'cpf_cnpj.required' => 'CPF Obrigatório.',
            'cpf_cnpj.cpf' => 'O CPF informado é inválido.',
            'cpf_cnpj.cnpj' => 'O CPF informado é inválido.',
            'telefone.required' => 'Telefone obrigatório.',
            'telefone.telefone' => 'O telefone informado é inválido.',
            'celular.required' => 'Celular obrigatório.',
            'celular.celular' => 'O Celular informado é inválido.',
        ];
    }

}
