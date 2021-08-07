<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistica;
use App\Models\Pacote;
use App\Models\Transportadora;

class LogisticaController extends Controller
{
    public function Logistica(){

        $data = Transportadora::all();

        $data2 = Logistica::all();
        $data3 = Pacote::all();

        return view('dashboard.logistica', [
            'transportadoras' => $data,
            'logisticas' => $data2,
            'pacotes' => $data3,
        ]);
    }
}
