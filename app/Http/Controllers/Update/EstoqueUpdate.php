<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\EstoqueRequest;
use App\Models\Estoque;
use App\Models\Notificacao;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EstoqueUpdate extends Controller
{

    protected function editEstoque($id)
    {
        $object = Estoque::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Estoque
     */
    protected function updateEstoque(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'IDDimensaoUp' => ['required'],
                'IDCorUp' => ['required'],
                'produtoEstoqueUp' => ['required'],
                'qtdeEstoqueUp' => ['required', 'integer'],
                'dataEstoqueUp' => ['required'],
                'timeEstoqueUp' => ['required'],
                'statusEstoqueUp' => ['required', 'string'],
            ],
            [
                'IDDimensaoUp.required' => 'Dimensão obrigatória.',
                'IDCorUp.required' => 'Cor obrigatória.',
                'produtoEstoqueUp.required' => 'Produto obrigatório.',
                'qtdeEstoqueUp.required' => 'Quantidade obrigatória.',
                'statusEstoqueUp.required' => 'Status obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Estoque = Estoque::find($request->idEst);
        $Estoque->dim_id = $request->IDDimensaoUp;
        $Estoque->cor_id = $request->IDCorUp;
        $Estoque->pro_id = $request->produtoEstoqueUp;
        $Estoque->est_qtde = $request->qtdeEstoqueUp;
        $Estoque->est_data = $request->dataEstoqueUp;
        $Estoque->est_time = $request->timeEstoqueUp;
        $Estoque->est_status = $request->statusEstoqueUp;
        $Estoque->save();

        if ($Estoque) {
            return response()->json(['status' => 1, 'msg' => 'Entrada atualizada com sucesso!']);
        }
    }
}
