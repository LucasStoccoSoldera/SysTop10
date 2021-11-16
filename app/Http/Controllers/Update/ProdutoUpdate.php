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
        return response()->json($object);
    }

    /**
     * @return \App\Models\Produto
     */
    protected function updateProduto(Request $request)
    {

        $request->PersoProduto = (!isset($request->PersoProduto))? 'Não' : 'Sim';
        $request->TerceProduto = (!isset($request->TerceProduto))? 'Não' : 'Sim';

        $validator = Validator::make(
            $request->all(),
            [
                'IDProdutoUp' => ['required'],
                'NomeProdutoUp' => ['required'],
                'TipoProdutoUp' => ['required', 'integer'],
                'PCProdutoUp' => ['required'],
                'PVProdutoUp' => ['required'],
                'MaterialProdutoUp' => ['required', 'integer'],
                'LogisticaProdutoUp' => ['required', 'integer'],
                'PedidoMinimoProdutoUp' => ['required', 'integer'],
                'FotoProdutoUp' => ['required', 'image', 'dimensions:width=2000,height=2000'],
                'DescricaoProdutoUp' => ['required'],
            ],
            [
                'IDProdutoUp' => 'ID obrigatório.',
                'NomeProdutoUp.required' => 'Nome obrigatório.',
                'TipoProdutoUp.required' => 'Tipo obrigatório.',
                'PCProdutoUp.required' => 'Preço de custo obrigatório.',
                'PVProdutoUp.required' => 'Preço de venda obrigatório.',
                'MaterialProdutoUp.required' => 'Material obrigatório.',
                'LogisticaProdutoUp.required' => 'Pacote obrigatório.',
                'FotoProdutoUp.required' => 'Foto do produto obrigatória.',
                'FotoProdutoUp.image' => 'Arquivo não é uma imagem.',
                'FotoProdutoUp.dimensions' => 'Dimensão de 2000 x 2000.',
                'PedidoMinimoProdutoUp.required' => 'Pedido Mínimo obrigatório.',
                'DescricaoProdutoUp.required' => 'Descrição obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $random = rand(1,1000);
        $nameFile = strtotime("now") . "_" . "$random" . $request->FotoProdutoUp->extension();

        $Produto = Produto::find($request->idPro);
        $Produto->id = $request->IDProdutoUp;
        $Produto->pro_nome = $request->NomeProdutoUp;
        $Produto->tpp_id = $request->TipoProdutoUp;
        $Produto->log_id = $request->LogisticaProdutoUp;
        $Produto->pro_precocusto = $request->PCProdutoUp;
        $Produto->pro_precovenda = $request->PVProdutoUp;
        $Produto->pro_promocao = $request->PromocaoProdutoUp;
        $Produto->mat_id = $request->MaterialProdutoUp;
        $Produto->pro_pedidominimo = $request->PedidoMinimoProdutoUp;
        $Produto->pro_foto_path = $nameFile;
        $Produto->pro_personalizacao = $request->PersoProdutoUp;
        $Produto->pro_terceirizacao = $request->TerceProdutoUp;
        $Produto->pro_descricao = $request->DescricaoProdutoUp;
        $Produto->save();

        $upload = $request->FotoProdutoUp->storeAs('fotos', $nameFile);

        if ($Produto) {
            return response()->json(['status' => 1, 'msg' => 'Produto atualizado com sucesso!']);
        }
    }

    protected function preenchePV(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'custoPV' => ['required'],
                'impostoPV' => ['required'],
                'comissaoPV' => ['required'],
                'custofixoPV' => ['required'],
                'lucroPV' => ['required'],
            ],
            [
                'custoPV.required' => 'Custo obrigatório.',
                'impostoPV.required' => 'Imposto obrigatório.',
                'comissaoPV.required' => 'Comissão obrigatório.',
                'custofixoPV.required' => 'Custo Fixo obrigatório.',
                'lucroPV.required' => 'Lucro obrigatório.',
            ]
        );

        $Custo = $request->custoPV;
        $Imposto = $request->impostoPV;
        $Comissao = $request->comissaoPV;
        $CustoFixo = $request->custofixoPV;
        $Lucro =  $request->lucroPV;

        $Soma = $Imposto + $Comissao + $CustoFixo + $Lucro;
        $Dividendo =1 - $Soma / 100;
        $PV = $Custo / $Dividendo;

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        return response()->json(['status' => 1, 'PV' => round($PV, 2), 'msg' => 'Cálculo realizado!']);
    }
}
