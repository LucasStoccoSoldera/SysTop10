<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Dimensao;
use App\Models\DimensaoProduto;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

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
        $codigo = DB::table('dimensoes')->where('dim_descricao', '=', $request->NomeDimensao)->first();

        Schema::table('dimensao_produto', function (Blueprint $table) use ($codigo) {
            $table->char('dd'.$codigo->id)->default(0);
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
                'produtoDimensaoProduto' => ['required'],
            ],
            [
                'produtoDimensaoProduto.required' => 'Produto obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $DimensaoProduto = new DimensaoProduto;

        if (DimensaoProduto::where('pro_id', '<>', $request->produtoDimensaoProduto)) {

            $DimensaoProduto->pro_id = $request->produtoDimensaoProduto;
        }
        $DimensaoProduto->save();

        $dimensoes = $request->dimensoes;

            if ($dimensoes) {
                foreach($request->dimensoes as $campo => $value){
                    DB::update("update dimensao_produto set $campo = $value where pro_id = $request->produtoDimensaoProduto");
                }
            }

        if ($DimensaoProduto) {
            return response()->json(['status' => 1, 'msg' => 'Dimensões vinculadas com sucesso!']);
        }
    }

}
