<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Cor;
use App\Models\CorProduto;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class CoresRegister extends Controller
{
    /**
     * @return \App\Models\Cor
     */
    public function createCor(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'NomeCores' => ['required', 'string'],
            ],
            [
                'NomeCores.required' => 'Nome da cor obrigatório.',
            ]
        );
        if ($request->CodigoCores != "#000000" || !empty($request->EspecialCores)) {
            if (isset($request->EspecialCores)) {
                $validator_cor_especial = Validator::make(
                    $request->all(),
                    [
                        'EspecialCores' => ['required', 'string'],
                    ],
                    [
                        'EspecialCores.required' => 'Cor especial obrigatório.',
                    ]
                );
                $cor = $request->EspecialCores;
            } else {
                $validator_cor_especial = Validator::make(
                    $request->all(),
                    [
                        'CodigoCores' => ['required', 'string'],
                    ],
                    [
                        'CodigoCores.required' => 'Código obrigatório.',
                    ]
                );
                $cor = $request->CodigoCores;
            }
        } else {
            $validator_cor_especial = Validator::make(
                $request->all(),
                [
                    'CodigoCores' => ['integer'],
                    'EspecialCores' => ['required', 'string'],
                ],
                [
                    'CodigoCores.integer' => 'Código ou Especial obrigatórios.',
                    'EspecialCores.required' => 'Código ou Especial obrigatórios.',
                ]
            );
        }

        if ($validator->fails() || $validator_cor_especial->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), 'error_cor_especial' => $validator_cor_especial->errors()]);
        }
        $Cor = new Cor;
        $Cor->cor_nome = $request->NomeCores;
        $Cor->cor_hex_especial = $cor;
        $Cor->save();

        Schema::table('cor_produto', function (Blueprint $table) use ($request) {
            return $table->char($request->NomeCores)->default(0);
        });

        if ($Cor) {
            return response()->json(['status' => 1, 'msg' => 'Cor cadastrada com sucesso!']);
        }
    }

    protected function createCorProduto(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'produtoCorProduto' => ['required'],
            ],
            [
                'produtoCorProduto.required' => 'Produto obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $CorProduto = new CorProduto;

        if (CorProduto::where('pro_id', '<>', $request->produtoCorProduto)) {
            $CorProduto->pro_id = $request->produtoCorProduto;
        }
        $CorProduto->save();

        $cores = $request->cores;

        if ($cores) {
            foreach ($request->cores as $campo => $value) {
                DB::update("update cor_produto set $campo = $value where pro_id = $request->produtoCorProduto");
            }
        }

        if ($CorProduto) {
            return response()->json(['status' => 1, 'msg' => 'Cores vinculadas com sucesso!']);
        }
    }
}
