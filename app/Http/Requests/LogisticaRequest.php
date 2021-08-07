<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LogisticaRequest extends FormRequest
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
            'pacoteLogistica' => ['required', 'integer'],
            'transLogistica' => ['required', 'integer'],
        ];
    }

    public function message()
    {
        return [
            'pacoteLogistica.required' => 'Pacote obrigatório.',
            'transLogistica.required' => 'Transportadora obrigatória.',
        ];
    }

}
