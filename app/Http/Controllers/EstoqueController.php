<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Dimensao;
use App\Models\Cor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class EstoqueController extends Controller
{
    public function Estoque(){

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

        $dado1 = DB::table('estoque')->sum('est_qtde');
        $dado2 = DB::table('estoque')->sum('est_qtde');
       $dado3 =  Estoque::select('pro_id')->groupBy('pro_id')->having('pro_id', '>', 1)->orderBy('est_qtde', 'desc')->first();
       $dado3 = str_replace('{"pro_id":', '', $dado3);
        $dado3 = str_replace('}', '', $dado3);
        $data = Estoque::all();
        $data2 = Produto::all();
        $data3 = Dimensao::all();
        $data4 = Cor::all();

        return view('dashboard.estoque', [

            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,

            'entradas' => $data,
            'produtos' => $data2,
            'dimensoes' => $data3,
            'cores' => $data4
        ]);
    }
}
