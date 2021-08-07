<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemVendaRequest extends FormRequest
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
            'IDCor' => ['required', 'integer'],
            'IDDimensao' => ['required', 'integer'],
            'IDProduto' => ['required', 'integer'],
            'IDItemVenda' => ['required', 'integer'],
            'qtdeItemVenda' => ['required', 'integer'],
            'descricaoItemVenda' => ['required', 'string'],
            'anexoItemVenda' => ['image'],
            'VUItemVenda' => ['required'],
        ];
    }

    public function message()
    {
        return [
            'IDCor.required' =>'Cor obrigatória.',
            'IDDimensao.required' => 'Dimensão obrigatória.',
            'IDProduto.required' => 'Produto obrigatório.',
            'IDItemVenda.required' => 'ID da venda obrigatório.',
            'qtdeItemVenda.required' => 'Quantidade obrigatória.',
            'descricaoItemVenda.required' => 'Descrição obrigatório.',
            'anexoItemVenda.image' => 'O arquivo precisa ser uma imagem.',
            'VUItemVenda.required' => 'Valor unitário obrigatório.',
        ];
    }

}
