<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Logistica;
use App\Models\Pacote;
use App\Models\Transportadora;

class LogisticaList extends Controller
{
    public function listLogistica(){

        $data = Transportadora::all();

        $data2 = Logistica::all();
        $data3 = Pacote::all();

        return  response()->json(['pacotes' => $data3, 'transportadoras' => $data, 'logisticas' => $data2]);
    }
}
