<?php

namespace App\Http\Controllers;

use App\Models\Contas_a_Receber;
use App\Models\TipoPagto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ContasaReceberController extends Controller
{
    public function ContasaReceber(){

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

        $dado3 = DB::table('contas_a_receber')->where('created_at', '>=', $ontem)->sum('rec_valor');
        $dado2 = DB::table('contas_a_receber')->where('created_at', '>=', $mes_passado)->sum('rec_valor');
        $dado1 = DB::table('contas_a_receber')->where('created_at', '>=', $ano)->sum('rec_valor');

        $data = Contas_a_Receber::all();
        $data1 = TipoPagto::all();

        return view('dashboard.contasareceber', [

            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,
            'creditos' => $data,
            'pagamentos' => $data1
        ]);
    }
}
