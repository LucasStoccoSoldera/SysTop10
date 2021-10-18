<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Models\Transportadora;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TransportadoraUpdate extends Controller
{
    protected function editTransportadora($id)
    {
        $object = Transportadora::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Transportadora
     */
    protected function updateTransportadora(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nomeTrans' => ['required'],
                'limitetransTrans' => ['required'],
            ],
            [
                'nomeTrans.required' => 'Transportadora obrigatória.',
                'limitetransTrans.required' => 'Limite obrigatório.',
            ]
        );

        if (isset($request->telefoneTrans) && isset($request->celularTrans)) {

            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneTrans' => ['telefone'],
                    'celularTrans' => ['celular_com_ddd'],
                ],
                [
                    'telefoneTrans.telefone' => 'Telefone inválido.',
                    'celularTrans.celular_com_ddd' => 'Celular inválido.',
                ]
            );
        } else{
        if (!empty($request->telefoneTrans || $request->celularTrans)) {

            if (isset($request->telefoneTrans)) {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'telefoneTrans' => ['telefone'],
                    ],
                    [
                        'telefoneTrans.telefone' => 'Telefone inválido.',
                    ]
                );
                $telefone = $request->telefoneTrans;
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'celularTrans' => ['celular_com_ddd'],
                    ],
                    [
                        'celularTrans.celular_com_ddd' => 'Celular inválido.',
                    ]
                );
            }
        } else {
            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneTrans' => ['required'],
                    'celularTrans' => ['required'],
                ],
                [
                    'telefoneTrans.required' => 'Telefone ou Celular obrigatórios.',
                    'celularTrans.required' => 'Telefone ou Celular obrigatórios.',
                ]
            );
        }
    }

        if ($validator->fails() || $validator_telefone_celular->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(),  'error_telefone_celular' => $validator_telefone_celular->errors()]);
        }

        $Transportadora = new Transportadora;
        $Transportadora->trans_nome = $request->nomeTrans;
        $Transportadora->trans_telefone = $request->telefoneTrans;
        $Transportadora->trans_celular = $request->celularTrans;
        $Transportadora->trans_limite_transporte = $request->limitetransTrans;
        $Transportadora->save();

        if ($Transportadora) {
            return response()->json(['status' => 1, 'msg' => 'Transportadora cadastrada com sucesso!']);
        }
    }
}
