<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendaRequest extends FormRequest
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
            'IDVenda' => ['required', 'integer'],
            'IDTipoPagamento' => ['required', 'integer'],
            'IDLogistica' => ['required', 'integer'],
            'IDCliente' => ['required', 'integer'],
            'VTVenda' => ['required'],
            'parcelasVenda' => ['required', 'integer'],
            'statusVenda' => ['required', 'string'],
        ];
    }

    public function message()
    {
        return [
            'IDVenda.required' => 'ID obrigatório.',
            'IDTipoPagamento.required' => 'Tipo de pagamento obrigatório.',
            'IDLogistica.required' => 'Logistica obrigatória.',
            'IDCliente.required' => 'Cliente obrigatório.',
            'parcelasVenda.required' => 'Quantidade de parcelas obrigatória.',
            'statusVenda.required' => 'Status da venda obrigatório.',
        ];
    }

}
