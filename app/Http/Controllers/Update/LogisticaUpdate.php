<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogisticaRequest;
use App\Models\Logistica;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LogisticaUpdate extends Controller
{

    protected function editLogistica($id)
    {
        $object = Logistica::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Logistica
     */
    protected function updateLogistica(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pacoteLogisticaUp' => ['required', 'integer'],
                'transLogisticaUp' => ['required', 'integer'],
            ],
            [
                'pacoteLogisticaUp.required' => 'Pacote obrigatório.',
                'transLogisticaUp.required' => 'Transportadora obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Logistica = Logistica::find($request->idLog);
        $Logistica->pac_id = $request->pacoteLogisticaUp;
        $Logistica->trans_id = $request->transLogisticaUp;
        $Logistica->save();

        if ($Logistica) {
            return response()->json(['status' => 1, 'msg' => 'Logistica atualizada com sucesso!']);
        }
    }
}
