<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstoqueRequest;
use App\Models\Estoque;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EstoqueUpdate extends Controller
{

    protected function editEstoque(Request $request)
    {
        $object = Estoque::find($request->IDEdit)->get();
        return response()->json(compact('object'));
    }

    /**
     * @return \App\Models\Estoque
     */
    protected function updateEstoque(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'IDDimensao' => ['required', 'integer'],
                'IDCor' => ['required', 'integer'],
                'qtdeEstoque' => ['required', 'integer'],
                'statusEstoque' => ['required', 'string'],
            ],
            [
                'IDDimensao.required' => 'Dimensão obrigatória.',
                'IDCor.required' => 'Cor obrigatória.',
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
        $Estoque->est_qtde = $request->qtdeEstoque;
        $Estoque->est_status = $request->statusEstoque;
        $Estoque->est_limite = $request->limiteEstoque;
        $Estoque->save();

        if ($Estoque) {
            return response()->json(['status' => 1, 'msg' => 'Entrada cadastrada com sucesso!']);
        }
    }
}
