<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Material_Base;
use App\Models\TipoProduto;
use App\Models\Pacote;
use App\Models\Cor;
use App\Models\Dimensao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ProdutosController extends Controller
{
    public function Produto(){

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

        $dado1 = Produto::count();
        $dado2 = 'teste'; //DB::table('vendas_detalhe')
                   //                                    -> join('produto', 'vendas_detalhe.pro_id', '=', 'produto.pro_id')
                    //                                   -> select('produto.pro_descricao')
                     //                                  ->distinct()
                      //                                 ->sum('det_qtde')
                       //                                ->max()
                        //                                ->orderByDesc('produto.pro_descricao');
                                             //           ->first();
        $dado3 = DB::table('produto')->where('pro_promocao', '=', 'Sim')->count();

        $data = Produto::all();
        $data2 = TipoProduto::all();
        $data3 = Material_Base::all();
        $data4 = Pacote::all();
        $data5 = Dimensao::all();
        $data6 = Cor::all();


        return view('dashboard.produtos', [

            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,

            'produtos' => $data,
            'tipos' => $data2,
            'materiais' => $data3,
            'pacotes' => $data4,
            'dimensoes' => $data5,
            'cores' => $data6,

        ]);
    }
}
