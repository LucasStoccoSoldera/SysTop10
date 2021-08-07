<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\DimensoesRequest;
use App\Models\Dimensao;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class DimensoesRegister extends Controller
{

    /**
     * @return \App\Models\Dimensao
     */
    protected function createDimensao(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nomeDimensao' => ['required', 'string'],
            ],
            [
                'nomeDimensao.required' => 'Dimensão obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Dimensao = new Dimensao;
        $Dimensao->dim_descricao = $request->nomeDimensao;
        $Dimensao->save();

        if ($Dimensao) {
            return response()->json(['status' => 1, 'msg' => 'Dimensão cadastrada com sucesso!']);
        }
    }
}
