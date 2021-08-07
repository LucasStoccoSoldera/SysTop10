<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CoresRequest extends FormRequest
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
            'NomeCores' => ['required', 'string'],
            'CodigoCores' => ['required', 'string'],
            'EspecialCores' => ['required', 'string'],
        ];
    }

    public function message(Request $request)
    {
        return [
            'NomeCores.required' => 'Nome da cor obrigatório.',
        ];
    }

}
