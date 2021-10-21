<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Models\Dimensao;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class DimensoesUpdate extends Controller
{

    protected function editDimensao($id)
    {
        $object = Dimensao::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Dimensao
     */
    protected function updateDimensao(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'NomeDimensaoUp' => ['required', 'string'],
            ],
            [
                'NomeDimensaoUp.required' => 'Dimensão obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $Dimensao = new Dimensao;
        $Dimensao->dim_descricao = $request->NomeDimensaoUp;
        $Dimensao->save();

        Schema::table('dimensao_produto', function (Blueprint $table) use ($request) {
            $table->char($request->NomeDimensaoUp)->default(0);
        });

        if ($Dimensao) {
            return response()->json(['status' => 1, 'msg' => 'Dimensão atualizada com sucesso!']);
        }
    }
}
