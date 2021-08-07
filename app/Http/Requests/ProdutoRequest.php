<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'nomeProduto' => ['required', 'string'],
            'tipoProduto' => ['required', 'integer'],
            'PCProduto' => ['required'],
            'PCVenda' => ['required'],
            'materialProduto' => ['required', 'integer'],
            'logistica' => ['required', 'integer'],
            'dimensaoProduto' => ['required', 'integer'],
            'pedidoMinimo' => ['integer'],
            'foto' => ['required', 'image', 'dimensions:width=100,height=200'],
        ];
    }

    public function message()
    {
        return [
            'nomeProduto.required' => 'Nome obrigatório.',
            'tipoProduto.required' => 'Tipo obrigatório.',
            'PCProduto.required' => 'Preço de custo obrigatório.',
            'PCVenda.required' => 'Preço de venda obrigatório.',
            'materialProduto.required' => 'Material obrigatório.',
            'logistica.required' => 'Logística obrigatória.',
            'dimensaoProduto.required' => 'Dimensão obrigatória.',
            'foto.required' => 'Foto do produto obrigatória.',
            'foto.dimensions' => 'A foto do produto precisa ter a dimensão de 200 x 200.',
        ];
    }

}
