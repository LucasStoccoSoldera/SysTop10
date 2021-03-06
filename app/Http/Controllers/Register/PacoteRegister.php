<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\PacoteRequest;
use App\Models\Pacote;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class PacoteRegister extends Controller
{

    /**
     * @return \App\Models\Pacote
     */
    protected function createPacote(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'DimensaoPacotes' => ['required', 'string'],
                'DescricaoPacotes' => ['required', 'string'],
            ],
            [
                'DimensaoPacotes.required' => 'Pacote obrigatório.',
                'DescricaoPacotes.required' => 'Dimensão obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Pacote = new Pacote;
        $Pacote->pac_dimensao = $request->DimensaoPacotes;
        $Pacote->pac_descricao = $request->DescricaoPacotes;
        $Pacote->save();

        if ($Pacote) {
            return response()->json(['status' => 1, 'msg' => 'Pacote cadastrado com sucesso!']);
        }
    }
}
