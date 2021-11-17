<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProdutoRegister extends Controller
{

    /**
     * @return \App\Models\Produto
     */
    protected function createProduto(Request $request)
    {

        $request->PCProduto = str_replace('R$ ', '', $request->PCProduto);
        $request->PCProduto = str_replace('.', '', $request->PCProduto);
        $request->PCProduto = str_replace(',', '.', $request->PCProduto);

        $request->PVProduto = str_replace('R$ ', '', $request->PVProduto);
        $request->PVProduto = str_replace('.', '', $request->PVProduto);
        $request->PVProduto = str_replace(',', '.', $request->PVProduto);

        $request->PersoProduto = (!isset($request->PersoProduto))? 'Não' : 'Sim';
        $request->TerceProduto = (!isset($request->TerceProduto))? 'Não' : 'Sim';

        $validator = Validator::make(
            $request->all(),
            [
                'IDProduto' => ['required'],
                'NomeProduto' => ['required'],
                'TipoProduto' => ['required', 'integer'],
                'PCProduto' => ['required'],
                'PVProduto' => ['required'],
                'MaterialProduto' => ['required', 'integer'],
                'LogisticaProduto' => ['required', 'integer'],
                'PedidoMinimoProduto' => ['required', 'integer'],
                'FotoProduto' => ['required', 'image', 'dimensions:width=2000,height=2000'],
                'DescricaoProduto' => ['required'],
            ],
            [
                'IDProduto' => 'ID obrigatório.',
                'NomeProduto.required' => 'Nome obrigatório.',
                'TipoProduto.required' => 'Tipo obrigatório.',
                'PCProduto.required' => 'Preço de custo obrigatório.',
                'PVProduto.required' => 'Preço de venda obrigatório.',
                'MaterialProduto.required' => 'Material obrigatório.',
                'LogisticaProduto.required' => 'Pacote obrigatório.',
                'anexoItemVenda.required' => 'Foto do produto obrigatória.',
                'FotoProduto.image' => 'Arquivo não é uma imagem.',
                'FotoProduto.required' => 'Foto do produto obrigatória.',
                'FotoProduto.dimensions' => 'Dimensão de 2000 x 2000.',
                'PedidoMinimoProduto.required' => 'Pedido Mínimo obrigatório.',
                'DescricaoProduto.required' => 'Descrição obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $random = rand(1,1000);
        $nameFile = strtotime("now") . "_" . "$random" . $request->FotoProduto->extension();

        $Produto = new Produto;
        $Produto->id = $request->IDProduto;
        $Produto->pro_nome = $request->NomeProduto;
        $Produto->tpp_id = $request->TipoProduto;
        $Produto->log_id = $request->LogisticaProduto;
        $Produto->pro_precocusto = $request->PCProduto;
        $Produto->pro_precovenda = $request->PVProduto;
        $Produto->pro_promocao = $request->PromocaoProduto;
        $Produto->mat_id = $request->MaterialProduto;
        $Produto->pro_pedidominimo = $request->PedidoMinimoProduto;
        $Produto->pro_foto_path = $nameFile;
        $Produto->pro_personalizacao = $request->PersoProduto;
        $Produto->pro_terceirizacao = $request->TerceProduto;
        $Produto->pro_descricao = $request->DescricaoProduto;
        $Produto->save();

        $upload = $request->FotoProduto->storeAs('fotos', $nameFile);

        if ($Produto) {
            return response()->json(['status' => 1, 'msg' => 'Produto cadastrado com sucesso!']);
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
