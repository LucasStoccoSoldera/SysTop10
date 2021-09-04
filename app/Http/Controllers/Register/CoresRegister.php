<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Cor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CoresRegister extends Controller
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

        if ($Cor) {
            return response()->json(['status' => 1, 'msg' => 'Cor cadastrada com sucesso!']);
        }
    }
}
