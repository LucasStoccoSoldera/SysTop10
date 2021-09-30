<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstoqueRequest;
use App\Models\Estoque;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EstoqueRegister extends Controller
{

    /**
     * @return \App\Models\Estoque
     */
    protected function createEstoque(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'IDDimensao' => ['required'],
                'IDCor' => ['required'],
                'produtoEstoque' => ['required'],
                'qtdeEstoque' => ['required', 'integer'],
                'dataEstoque' => ['required'],
                'timeEstoque' => ['required'],
                'statusEstoque' => ['required', 'string'],
            ],
            [
                'IDDimensao.required' => 'Dimensão obrigatória.',
                'IDCor.required' => 'Cor obrigatória.',
                'produtoEstoque.required' => 'Produto obrigatório.',
                'qtdeEstoque.required' => 'Quantidade obrigatória.',
                'statusEstoque.required' => 'Status obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Estoque = new Estoque;
        $Estoque->dim_id = $request->IDDimensao;
        $Estoque->cor_id = $request->IDCor;
        $Estoque->pro_id = $request->produtoEstoque;
        $Estoque->est_qtde = $request->qtdeEstoque;
        $Estoque->est_data = $request->dataEstoque;
        $Estoque->est_time = $request->timeEstoque;
        $Estoque->est_status = $request->statusEstoque;
        $Estoque->save();

        if ($Estoque) {
            return response()->json(['status' => 1, 'msg' => 'Entrada cadastrada com sucesso!']);
        }
    }
}
