<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\CentroCustoRequest;
use App\Models\Centro_Custo;
use App\Models\Notificacao;
use App\Providers\RouteServiceProvider;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CentroCustoRegister extends Controller
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;
    /**
     * @return \App\Models\Centro_Custo
     */
    protected function createCentroCusto(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'NomeCentroCusto' => ['required', 'string'],
            ],
            [
                'NomeCentroCusto.required' => 'Nome do centro de custo obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }

        $Centro_Custo = new Centro_Custo;
        $Centro_Custo->cc_descricao = $request->NomeCentroCusto;
        $Centro_Custo->save();

        if ($Centro_Custo) {
            return response()->json(['status' => 1, 'msg' => 'Centro cadastrado com sucesso!']);
        }
    }
}
