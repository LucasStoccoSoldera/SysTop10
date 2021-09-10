<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipoProdutoRequest;
use App\Models\TipoProduto;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class TipoProdutoUpdate extends Controller
{

    protected function editTipoProduto(Request $request)
    {
        $object = TipoProduto::find($request->IDEdit->get());
        return response()->json(compact('object'));
    }

    /**
     * @return \App\Models\TipoProduto
     */
    protected function updateTipoProduto(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'NomeTipoProduto' => ['required', 'string'],
            ],
            [
                'NomeTipoProduto.required' => 'Tipo de produto obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Tipo_Produto = new TipoProduto;
        $Tipo_Produto->tpp_descricao = $request->NomeTipoProduto;
        $Tipo_Produto->save();

        if ($Tipo_Produto) {
            return response()->json(['status' => 1, 'msg' => 'Tipo de produto cadastrado com sucesso!']);
        }
    }
}
