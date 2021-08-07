<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\TipoPagto;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class TipoPagtoRegister extends Controller
{

    /**
     * @return \App\Models\TipoPagto
     */
    protected function createTipoPagto(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'TPTipoPagto' => ['required', 'string'],
        ],
        [
            'TPTipoPagto.required' => 'Tipo de pagamento obrigatório.',
       ]);

        if($validator->fails()){
            return response()->json(['status' =>0, 'error' => $validator->errors()]);
        }
        
        $TipoPagto = new TipoPagto;
        $TipoPagto->tpg_descricao = $request->TPTipoPagto;
        $TipoPagto->save();

            if($TipoPagto){
                return response()->json(['status' => 1, 'msg' => 'Tipo de pagamento cadastrado com sucesso!']);
            }
        }
}
