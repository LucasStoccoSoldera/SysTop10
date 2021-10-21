<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\PacoteRequest;
use App\Models\Pacote;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class PacoteUpdate extends Controller
{
    protected function editPacote($id)
    {
        $object = Pacote::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Pacote
     */
    protected function updatePacote(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'DimensaoPacotesUp' => ['required', 'string'],
                'DescricaoPacotesUp' => ['required', 'string'],
            ],
            [
                'DimensaoPacotesUp.required' => 'Pacote obrigatório.',
                'DescricaoPacotesUp.required' => 'Dimensão obrigatória.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Pacote = Pacote::find($request->idPac);
        $Pacote->pac_dimensao = $request->DimensaoPacotesUp;
        $Pacote->pac_descricao = $request->DescricaoPacotesUp;
        $Pacote->save();

        if ($Pacote) {
            return response()->json(['status' => 1, 'msg' => 'Pacote atualizado com sucesso!']);
        }
    }
}
