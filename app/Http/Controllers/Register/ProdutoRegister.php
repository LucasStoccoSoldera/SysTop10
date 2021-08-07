<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ProdutoRegister extends Controller
{

    /**
     * @return \App\Models\Produto
     */
    protected function createProduto(Request $request)
    {
        $dataForm = $request->all();
        $dataForm['persoProduto'] = (!isset($dataForm['persoProduto']))? 0 : 1;
        $dataForm['terceProduto'] = (!isset($dataForm['terceProduto']))? 0 : 1;

        $validator = Validator::make($request->all(),[
            'nomeProduto' => ['required', 'string'],
            'tipoProduto' => ['required', 'integer'],
            'PCProduto' => ['required'],
            'PCVenda' => ['required'],
            'materialProduto' => ['required', 'integer'],
            'logistica' => ['required', 'integer'],
            'dimensaoProduto' => ['required', 'integer'],
            'pedidoMinimo' => ['integer'],
            'foto' => ['required', 'image', 'dimensions:width=100,height=200'],
        ],
        [
            'nomeProduto.required' => 'Nome obrigatório.',
            'tipoProduto.required' => 'Tipo obrigatório.',
            'PCProduto.required' => 'Preço de custo obrigatório.',
            'PCVenda.required' => 'Preço de venda obrigatório.',
            'materialProduto.required' => 'Material obrigatório.',
            'logistica.required' => 'Logística obrigatória.',
            'dimensaoProduto.required' => 'Dimensão obrigatória.',
            'foto.required' => 'Foto do produto obrigatória.',
            'foto.dimensions' => 'A foto do produto precisa ter a dimensão de 200 x 200.',
       ]);

        if($validator->fails()){
            return response()->json(['status' =>0, 'error' => $validator->errors()]);
        }
        $Produto = new Produto;
        $Produto->pro_nome = $request->nomeProduto;
        $Produto->tpp_id = $request->tipoProduto;
        $Produto->pro_precocusto = $request->PCProduto;
        $Produto->pro_precovenda = $request->PCVenda;
        $Produto->mat_id = $request->materialProduto;
        $Produto->log_id = $request->logistica;
        $Produto->dim_id = $request->dimensaoProduto;
        $Produto->pro_pedidominimo = $request->pedidoMinimo;
        $Produto->pro_foto_path = $request->foto;
        $Produto->pro_personalizacao = $request->  $dataForm['persoProduto'];
        $Produto->pro_terceirizacao = $request->  $dataForm['terceProduto'];
        $Produto->save();

            if($Produto){
                return response()->json(['status' => 1, 'msg' => 'Produto cadastrado com sucesso!']);
            }
        }
}


