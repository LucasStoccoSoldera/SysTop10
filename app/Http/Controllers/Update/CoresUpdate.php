<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Models\Cor;
use App\Models\CorProduto;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CoresUpdate extends Controller
{

    protected function editCor($id)
    {
        $object = Cor::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Cor
     */
    protected function updateCor(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'NomeCoresUp' => ['required', 'string'],
            ],
            [
                'NomeCoresUp.required' => 'Nome da cor obrigatório.',
            ]
        );
        if ($request->CodigoCores != "#000000" || !empty($request->EspecialCores)) {
            if (isset($request->EspecialCores)) {
                $validator_cor_especial = Validator::make(
                    $request->all(),
                    [
                        'EspecialCoresUp' => ['required', 'string'],
                    ],
                    [
                        'EspecialCoresUp.required' => 'Cor especial obrigatório.',
                    ]
                );
                $cor = $request->EspecialCoresUp;
            } else {
                $validator_cor_especial = Validator::make(
                    $request->all(),
                    [
                        'CodigoCoresUp' => ['required', 'string'],
                    ],
                    [
                        'CodigoCoresUp.required' => 'Código obrigatório.',
                    ]
                );
                $cor = $request->CodigoCoresUp;
            }
        } else {
            $validator_cor_especial = Validator::make(
                $request->all(),
                [
                    'CodigoCoresUp' => ['integer'],
                    'EspecialCoresUp' => ['required', 'string'],
                ],
                [
                    'CodigoCoresUp.integer' => 'Código ou Especial obrigatórios.',
                    'EspecialCoresUp.required' => 'Código ou Especial obrigatórios.',
                ]
            );
        }

        if ($validator->fails() || $validator_cor_especial->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), 'error_cor_especial' => $validator_cor_especial->errors()]);
        }
        $Cor = Cor::find($request->idCor);
        $Cor->cor_nome = $request->NomeCoresUp;
        $Cor->cor_hex_especial = $cor;
        $Cor->save();

        Schema::table('cor_produto', function (Blueprint $table) use ($request) {
            return $table->char($request->NomeCoresUp)->default(0);
        });

        if ($Cor) {
            return response()->json(['status' => 1, 'msg' => 'Cor atualizada com sucesso!']);
        }
    }
}
