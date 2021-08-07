<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\RuleTelefone;

class TransportadoraRequest extends FormRequest
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
            'nomeTrans' => ['required', 'string'],
            'telefone' => ['required', 'telefone'],
            'limitetransTrans' => ['required', 'integer'],
        ];
    }

    public function message()
    {
        return [
            'nomeTrans' => ['required', 'string'],
            'telefone' => ['required', 'telefone'],
            'limitetransTrans' => ['required', 'integer'],
        ];
    }

}
