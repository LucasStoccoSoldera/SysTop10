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
                'nomeTransUp' => ['required'],
                'limitetransTransUp' => ['required'],
            ],
            [
                'nomeTransUp.required' => 'Transportadora obrigatória.',
                'limitetransTransUp.required' => 'Limite obrigatório.',
            ]
        );

        if (isset($request->telefoneTrans) && isset($request->celularTrans)) {

            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneTransUp' => ['telefone'],
                    'celularTransUp' => ['celular_com_ddd'],
                ],
                [
                    'telefoneTransUp.telefone' => 'Telefone inválido.',
                    'celularTransUp.celular_com_ddd' => 'Celular inválido.',
                ]
            );
        } else{
        if (!empty($request->telefoneTrans || $request->celularTrans)) {

            if (isset($request->telefoneTrans)) {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'telefoneTransUp' => ['telefone'],
                    ],
                    [
                        'telefoneTransUp.telefone' => 'Telefone inválido.',
                    ]
                );
                $telefone = $request->telefoneTrans;
            } else {
                $validator_telefone_celular = Validator::make(
                    $request->all(),
                    [
                        'celularTransUp' => ['celular_com_ddd'],
                    ],
                    [
                        'celularTransUp.celular_com_ddd' => 'Celular inválido.',
                    ]
                );
            }
        } else {
            $validator_telefone_celular = Validator::make(
                [$request->all()],
                [
                    'telefoneTransUp' => ['required'],
                    'celularTransUp' => ['required'],
                ],
                [
                    'telefoneTransUp.required' => 'Telefone ou Celular obrigatórios.',
                    'celularTransUp.required' => 'Telefone ou Celular obrigatórios.',
                ]
            );
        }
    }

        if ($validator->fails() || $validator_telefone_celular->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors(),  'error_telefone_celular' => $validator_telefone_celular->errors()]);
        }

        $Transportadora = Transportadora::find($request->idTrans);
        $Transportadora->trans_nome = $request->nomeTransUp;
        $Transportadora->trans_telefone = $request->telefoneTransUp;
        $Transportadora->trans_celular = $request->celularTransUp;
        $Transportadora->trans_limite_transporte = $request->limitetransTransUp;
        $Transportadora->save();

        if ($Transportadora) {
            return response()->json(['status' => 1, 'msg' => 'Transportadora atualizada com sucesso!']);
        }
    }
}
