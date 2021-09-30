<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Dimensao;
use App\Models\DimensaoProduto;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
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

        Schema::table('dimensao_produto', function (Blueprint $table) use ($request) {
            $table->char($request->NomeDimensao)->default(0);
        });

        if ($Dimensao) {
            return response()->json(['status' => 1, 'msg' => 'Dimensão cadastrada com sucesso!']);
        }
    }

    protected function createDimensaoProduto(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'produtoCorProduto' => ['required', 'string'],
            ],
            [
                'produtoCorProduto.required' => 'Produto obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $Dimensao = new DimensaoProduto;
        $Dimensao->pro_id = $request->produtoCorProduto;

        $campos = $request->toArray();

        foreach($campos as $campo){
        $nome_campo = $_REQUEST;
        $request->campo = (!isset($request->campo))? 0 : 1;
        $Dimensao->nome_campo = $request->campo;
        }
        $Dimensao->save();

        if ($Dimensao) {
            return response()->json(['status' => 1, 'msg' => 'Dimensões vinculadas com sucesso!']);
        }
    }

}
