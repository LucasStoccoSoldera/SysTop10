<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Cor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CorRegister extends Controller
{

    /**
     * @return \App\Models\Cor
     */
    protected function createCor(Request $request)
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
        if (!empty($request->telefoneFornecedor && $request->celularFornecedor)) {
        if (isset($request->CodigoCores)) {
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
        } else{
            $validator_cor_especial = Validator::make(
                $request->all(),
                [
                    'EspecialCores' => ['required', 'string'],
                ],
                [
                    'EspecialCores.required' => 'Cor especial obrigatório.',
                ]
            );
        }
    } else{
        $validator_cor_especial = Validator::make(
            $request->all(),
            [
                'CodigoCores' => ['required', 'string'],
                'EspecialCores' => ['required', 'string'],
            ],
            [
                'CodigoCores.required' => 'Código ou Especial obrigatórios.',
                'EspecialCores.required' => 'Código ou Especial obrigatórios.',
            ]
        );
    }

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(), $validator_cor_especial->errors()]);
        }
        $Cor = new Cor;
        $Cor->cor_nome = $request->NomeCores;
        if (isset($cor)) {
            $Cor->cor_hex = $request->CodigoCores;
        } else {
            $Cor->cor_especial = $request->EspecialCores;
        }
        $Cor->save();

        if ($Cor) {
            return response()->json(['status' => 1, 'msg' => 'Cor cadastrada com sucesso!']);
        }
    }
}
