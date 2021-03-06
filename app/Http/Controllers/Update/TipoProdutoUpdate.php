<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoProdutoRequest;
use App\Models\TipoProduto;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class TipoProdutoUpdate extends Controller
{

    protected function editTipoProduto($id)
    {
        $object = TipoProduto::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\TipoProduto
     */
    protected function updateTipoProduto(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'NomeTipoProdutoUp' => ['required', 'string'],
            ],
            [
                'NomeTipoProdutoUp.required' => 'Tipo de produto obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Tipo_Produto = TipoProduto::find($request->idTpp);
        $Tipo_Produto->tpp_descricao = $request->NomeTipoProdutoUp;
        $Tipo_Produto->save();

        if ($Tipo_Produto) {
            return response()->json(['status' => 1, 'msg' => 'Tipo de produto atualizado com sucesso!']);
        }
    }
}
