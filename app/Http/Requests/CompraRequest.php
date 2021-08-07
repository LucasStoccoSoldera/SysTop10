<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraRequest extends FormRequest
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
            'IDCompras' => ['required', 'integer'],
            'descricaoCompras' => ['string'],
            'tpgpagtoCompras' => ['required', 'string'],
            'ccCompras' => ['required', 'string'],
            'parcelasCompra' => ['required', 'integer'],
            'qtdeCompras' => ['required', 'integer'],
            'VTCompras' => ['required'],
            'dataCompras' => ['required', 'date'],
            'datapagCompras' => ['date'],
            'obsCompras' => ['string'],
        ];
    }

    public function message()
    {
        return [
            'IDCompras.required' =>'ID da compra obrigatório.',
            'tpgpagtoCompras.required' => 'Tipo de pagamento obrigatório.',
            'ccCompras.required' => 'Centro de Custo obrigatório.',
            'parcelasCompra.required' => 'Quantidade de parcelas obrigatório.',
            'qtdeCompras.required' => 'Quantidade obrigatória.',
            'dataCompras.required' => 'Data da compra obrigatória.',
        ];
    }

}
