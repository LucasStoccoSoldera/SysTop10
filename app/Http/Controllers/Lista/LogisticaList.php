<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logistica;
use App\Models\Pacote;
use App\Models\Transportadora;
use App\Transformers\LogisticaTransformer;
use App\Transformers\TransportadoraTransformer;
use App\Transformers\PacoteTransformer;

class LogisticaList extends Controller
{
    public function listLogistica(Request $request){

        if($request->ajax()){

            $data = Logistica::select('logistica.id', 'pac_descricao', 'trans_nome')
            ->join('pacote', 'logistica.pac_id', '=', 'pacote.id')
            ->join('transportadora', 'logistica.trans_id', '=', 'transportadora.id');

            return DataTables::eloquent($data)
            ->setTransformer(new LogisticaTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
