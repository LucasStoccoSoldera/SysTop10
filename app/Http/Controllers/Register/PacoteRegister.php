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

        $validator = Validator::make($request->all(),[
            'nomePacotes' => ['required', 'string'],
            'descricaoPacotes' => ['required', 'string'],
        ],
        [
            'nomePacotes.required' => 'Pacote obrigatório.',
            'descricaoPacotes.required' => 'Dimensão obrigatória.',
       ]);

        if($validator->fails()){
            return response()->json(['status' =>0, 'error' => $validator->errors()]);
        }
        $Pacote = new Pacote;
        $Pacote->pac_dimensao = $request->nomePacotes;
        $Pacote->pac_descricao = $request->descricaoPacotes;
        $Pacote->save();

            if($Pacote){
                return response()->json(['status' => 1, 'msg' => 'Pacote cadastrado com sucesso!']);
            }
        }
}


