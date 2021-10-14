<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ProdutoUpdate extends Controller
{

    protected function editProduto($id)
    {
        $object = Produto::find($id);
        return response()->json('object');
    }

    /**
     * @return \App\Models\Produto
     */
    protected function updateProduto(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'IDProduto' => ['required', 'integer'],
                'NomeProduto' => ['required', 'string'],
                'TipoProduto' => ['required', 'integer'],
                'PCProduto' => ['required'],
                'PVProduto' => ['required'],
                'MaterialProduto' => ['required', 'integer'],
                'Logistica' => ['required', 'integer'],
                'DimensaoProduto' => ['required', 'integer'],
                'PacoteProduto' => ['required', 'integer'],
                'PedidoMinimo' => ['integer'],
                'FotoProduto' => ['required', 'image', 'dimensions:width=100,height=200'],
            ],
            [
                'IDProduto' => 'ID obrigatório.',
                'NomeProduto.required' => 'Nome obrigatório.',
                'TipoProduto.required' => 'Tipo obrigatório.',
                'PCProduto.required' => 'Preço de custo obrigatório.',
                'PVProduto.required' => 'Preço de venda obrigatório.',
                'MaterialProduto.required' => 'Material obrigatório.',
                'Logistica.required' => 'Logística obrigatória.',
                'DimensaoProduto.required' => 'Dimensão obrigatória.',
                'PacoteProduto.required' => 'Pacote obrigatório.',
                'FotoProduto.required' => 'Foto do produto obrigatória.',
                'FotoProduto.dimensions' => 'Dimensão de 200 x 200.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $nameFile = $request->fotoProduto->getClientOriginalName() . $request->fotoProduto->extension();

        $Produto = new Produto;
        $Produto->pro_id = $request->IDProduto;
        $Produto->pro_nome = $request->NomeProduto;
        $Produto->tpp_id = $request->TipoProduto;
        $Produto->pro_precocusto = $request->PCProduto;
        $Produto->pro_precovenda = $request->PVProduto;
        $Produto->pro_promocao = $request->PromocaoProduto;
        $Produto->mat_id = $request->MaterialProduto;
        $Produto->log_id = $request->Logistica;
        $Produto->dim_id = $request->DimensaoProduto;
        $Produto->pro_pedidominimo = $request->PedidoMinimo;
        $file = $request->FotoProduto;
        $upload = $request->FotoProduto->store('fotos');
        $Produto->pro_foto_path = $nameFile;
        $Produto->pro_personalizacao = $request->persoProduto;
        $Produto->pro_terceirizacao = $request->terceProduto;
        $Produto->save();

        if ($Produto) {
            return response()->json(['status' => 1, 'msg' => 'Produto cadastrado com sucesso!']);
        }
    }
}
