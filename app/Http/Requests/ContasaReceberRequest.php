<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContasaReceberRequest extends FormRequest
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
            'tipoPagtoReceber' => ['required', 'string'],
            'descricaoReceber' => ['required', 'string'],
            'IDVenda' => ['integer'],
            'valorReceber' => ['required'],
            'parcelasReceber' => ['required', 'integer'],
            'dataReceber' => ['required', 'date'],
        ];
    }

    public function message()
    {
        return [
            'tipoPagtoReceber.required' => 'Tipo de pagamento obrigatório.',
            'descricaoReceber.required' => 'Descrição obrigatória.',
            'valorReceber.required' => 'Valor obrigatório.',
            'parcelasReceber.required' => 'Quantidade de parcelas obrigatória.',
            'dataReceber.required' => 'Data do recebimento obrigatória.',
        ];
    }

}
