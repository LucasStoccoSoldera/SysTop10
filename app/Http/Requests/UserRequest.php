<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nomeUser' => ['required', 'string'],
            'usuarioUser' => ['required', 'email','unique:usuario'],
            'senhaUser' => ['required', 'string', 'confirmed'],
            'cargoUser' => ['required', 'string'],
        ];
    }

    public function message()
    {
        return [
            'nomeUser.required' => 'Nome obrigatório.',
            'usuarioUser.required' => 'E-mail obrigatório.',
            'usuarioUser.unique' => 'O E-mail informado ja está em uso.',
            'usuarioUser.email' => 'O E-mail informado é inválido.',
            'senhaUser.required' => 'Senha obrigatória.',
            'senhaUser.confirmed' => 'A confirmação da senha não corresponde.',
            'cargoUser.required' => 'Cargo obrigatório.',
        ];
    }

}
