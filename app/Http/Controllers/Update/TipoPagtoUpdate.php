<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Models\TipoPagto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TipoPagtoUpdate extends Controller
{

    protected function editTipoPagto($id)
    {
        $object = TipoPagto::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\TipoPagto
     */
    protected function updateTipoPagto(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'TPTipoPagto' => ['required', 'string'],
            ],
            [
                'TPTipoPagto.required' => 'Tipo de pagamento obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $TipoPagto = new TipoPagto;
        $TipoPagto->tpg_descricao = $request->TPTipoPagto;
        $TipoPagto->save();

        if ($TipoPagto) {
            return response()->json(['status' => 1, 'msg' => 'Tipo de pagamento cadastrado com sucesso!']);
        }
    }
}
