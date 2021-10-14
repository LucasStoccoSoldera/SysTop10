<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Models\Dimensao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DimensoesUpdate extends Controller
{

    protected function editDimensao($id)
    {
        $object = Dimensao::find($id);
        return response()->json('object');
    }

    /**
     * @return \App\Models\Dimensao
     */
    protected function updateDimensao(Request $request)
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
