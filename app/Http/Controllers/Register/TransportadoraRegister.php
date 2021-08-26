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
                'limitetransTrans' => ['required', 'integer'],
            ],
            [
                'nomeTrans.required' => 'Transportadora obrigatória.',
                'limitetransTrans.required' => 'Limite obrigatório.',
            ]
        );
        if (!empty($request->telefoneTrans || $request->celularTrans)) {
            if (isset($request->telefoneTrans) && isset($request->celularTrans)) {

            if (isset($request->telefoneTrans)) {
                $validator_telefone_celular = Validator::make(
                    $request->telefoneTrans,
                    [
                        'telefoneTrans' => ['required', 'telefone'],
                    ],
                    [
                        'telefoneTrans.required' => 'Telefone obrigatório.',
                        'telefoneTrans.telefone' => 'Telefone inválido.',
                    ]
                );
                $telefone = $request->telefoneTrans;
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->celularTrans,
                    [
                        'celularTrans' => ['required', 'celular'],
                    ],
                    [
                        'celularTrans.required' => 'Celular obrigatório.',
                        'celularTrans.celular' => 'Celular inválido.',
                    ]
                );
            }
        } else {
            $validator_telefone_celular = Validator::make(
                [$request->telefoneTrans, $request->celularTrans],
                [
                    'telefoneTrans' => ['required', 'telefone'],
                    'celularTrans' => ['required', 'celular'],
                ],
                [
                    'telefoneTrans.required' => 'Telefone ou Celular obrigatórios.',
                    'celularTrans.required' => 'Telefone ou Celular obrigatórios.',
                ]
            );
        }
    } else {
        $validator_telefone_celular = Validator::make(
            [$request->telefoneTrans, $request->celularTrans],
            [
                'telefoneTrans' => ['telefone'],
                'celularTrans' => ['celular'],
            ],
            [
                'telefoneTrans.telefone' => 'Telefone inválido.',
                'celularTrans.celular' => 'Celular inválido.',
            ]
        );
    }

        if ($validator->fails() || $validator_telefone_celular->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(),  'error_telefone_celular' => $validator_telefone_celular->errors()]);
        }

        $Transportadora = new Transportadora;
        $Transportadora->trans_nome = $request->nomeTrans;
        if (isset($telefone)) {
            $Transportadora->cli_telefone = $request->telefoneTrans;
        } else {
            $Transportadora->cli_celular = $request->celularTrans;
        }
        $Transportadora->trans_limite_transporte = $request->limitetransTrans;
        $Transportadora->save();

        if ($Transportadora) {
            return response()->json(['status' => 1, 'msg' => 'Transportadora cadastrada com sucesso!']);
        }
    }
}
