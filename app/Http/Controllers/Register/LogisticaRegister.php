<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\LogisticaRequest;
use App\Models\Logistica;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LogisticaRegister extends Controller
{

    /**
     * @return \App\Models\Logistica
     */
    protected function createLogistica(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'pacoteLogistica' => ['required', 'integer'],
                'transLogistica' => ['required', 'integer'],
            ],
            [
                'pacoteLogistica.required' => 'Pacote obrigatório.',
                'transLogistica.required' => 'Transportadora obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Logistica = new Logistica;
        $Logistica->pac_id = $request->pacoteLogistica;
        $Logistica->trans_id = $request->transLogistica;
        $Logistica->save();

        if ($Logistica) {
            return response()->json(['status' => 1, 'msg' => 'Logistica cadastrada com sucesso!']);
        }
    }
}
