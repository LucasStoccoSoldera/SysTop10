<?php

namespace App\Http\Controllers;

use App\Models\Logistica;
use App\Models\Centro_Custo;
use App\Models\TipoPagto;
use App\Models\Transportadora;
use App\Models\Pacote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class DetalhesController extends Controller
{
    public function Detalhe() {

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

        $data = Logistica::all();
        $data2 = Centro_Custo::all();
        $data3 = TipoPagto::all();


        $relacao_total = Logistica::count();
            $transportadora_total = Transportadora::count();
            $pacotes_total = Pacote::count();


        return view('dashboard.detalhes', [
            'logisticas' => $data,
            'centros' => $data2,
            'pagamentos' => $data3,
            'relacao_total' => $relacao_total,
            'transportadora_total' => $transportadora_total,
            'pacotes_total' => $pacotes_total
            ]);
    }

    public function Logistica(){
        return view('dashboard.logistica');
    }
}
