<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemCompraRequest extends FormRequest
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
            'IDItemCompra' => ['required', 'integer'],
            'IDFornecedor' => ['required', 'integer'],
            'IDProduto' => ['required', 'integer'],
            'qtdeItemCompra' => ['required', 'integer'],
            'descricaoItemCompra' => ['required', 'string'],
        ];
    }

    public function message()
    {
        return [
            'IDItemCompra.required' => 'ID da compra obrigatório.',
            'IDFornecedor.required' => 'Fornecedor obrigatório.',
            'IDProduto.required' => 'Produto obrigatório.',
            'qtdeItemCompra.required' => 'Quantidade obrigatória.',
            'descricaoItemCompra.required' => 'Descrição obrigatória.',
        ];
    }

}
