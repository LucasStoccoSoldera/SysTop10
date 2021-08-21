<?php

namespace App\Http\Controllers;

use App\Models\Fornecedores;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class FornecedoresController extends Controller
{
    public function Fornecedores(){

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

        $data = Fornecedores::limit(25)->get();
        $data2 = Produto::all();

        return view('dashboard.fornecedores', [

            'fornecedores' => $data,
             'produtos' => $data2
        ]);
    }
}
