<?php

namespace App\Http\Controllers;

use App\Models\Logistica;
use App\Models\Pacote;
use App\Models\Transportadora;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class LogisticaController extends Controller
{
    public function Logistica(){

        $ano = date("Y");
        $mes = date("m");
        $dia = date("d");
        $hora = date("H");
        $minuto = date("i");
        $segundo = date("s");
        $now = date("Y-m-d H:i:s");
        $ontem = Carbon::now()->subDay();
        $mes_passado = Carbon::now()->subMonth();
        $ano_passado = Carbon::now()->subYear();

        $data = Transportadora::all();

        $data2 = Logistica::all();
        $data3 = Pacote::all();

        return view('dashboard.logistica', [
            'transportadoras' => $data,
            'logisticas' => $data2,
            'pacotes' => $data3
        ]);
    }
}
