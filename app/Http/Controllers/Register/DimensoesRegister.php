<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Dimensao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DimensaoRegister extends Controller
{

    /**
     * @return \App\Models\Dimensao
     */
    protected function createDimensao(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'NomeDimensao' => ['required', 'string'],
            ],
            [
                'NomeDimensao.required' => 'Dimensão obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }


        $Dimensao = new Dimensao;
        $Dimensao->dim_descricao = $request->NomeDimensao;
        $Dimensao->save();

        if ($Dimensao) {
            return response()->json(['status' => 1, 'msg' => 'Dimensão cadastrada com sucesso!']);
        }
    }
}
