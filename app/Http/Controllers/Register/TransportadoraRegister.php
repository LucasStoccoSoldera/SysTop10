<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Transportadora;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TransportadoraRegister extends Controller
{

    /**
     * @return \App\Models\Transportadora
     */
    protected function createTransportadora(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nomeTrans' => ['required', 'string'],
                'telefoneTrans' => ['required', 'telefone'],
                'limitetransTrans' => ['required', 'integer'],
            ],
            [
                'nomeTrans.required' => 'Transportadora obrigatória.',
                'telefoneTrans.required' => 'Telefone obrigatório.',
                'telefoneTrans.telefone' => 'Telefone inválido.',
                'limitetransTrans.required' => 'Limite obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Transportadora = new Transportadora;
        $Transportadora->trans_nome = $request->nomeTrans;
        $Transportadora->trans_telefone = $request->telefone->preg_replace('/[^0-9]/', '');
        $Transportadora->trans_limite_transporte = $request->limitetransTrans;
        $Transportadora->save();

        if ($Transportadora) {
            return response()->json(['status' => 1, 'msg' => 'Transportadora cadastrada com sucesso!']);
        }
    }
}
