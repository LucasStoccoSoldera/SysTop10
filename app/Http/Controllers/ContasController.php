<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contas_a_Pagar;
use App\Models\TipoPagto;
use App\Models\Centro_Custo;
use App\Models\Parcelas;
use App\Models\Produto;
use App\Models\Fornecedores;
use App\Models\Compras_Detalhe;
use App\Models\Dimensao;
use App\Models\Cor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class ContasController extends Controller
{
    public function Contas(Request $request){

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


        $dado1 = DB::table('contas_a_pagar')->where('created_at', '>=', $mes_passado)->where('con_tipo', '=', 'Fixa')->sum('con_valor_final');
        $dado2 = DB::table('contas_a_pagar')->where('created_at', '>=', $mes_passado)->where('con_tipo', '=', 'Variável')->sum('con_valor_final');
        $dado3 = DB::table('contas_a_pagar')->sum('con_valor_final');

        $data1 = Contas_a_Pagar::all();
        $data2 = Centro_Custo::all();
        $data3 = TipoPagto::all();
        $data4 = Compras_Detalhe::where('com_id', $request->IDCompra);

        $data5 = Fornecedores::all();
        $data6 = Produto::all();

        $data7 = Parcelas::all();

        $data8 = Dimensao::all();
        $data9 = Cor::all();



        return view('dashboard.contas', [

            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,
            'contas' => $data1,
            'centros' => $data2,
            'pagamentos' => $data3,
            'ItensCompra' => $data4,
            'fornecedores' => $data5,
            'produtos' => $data6,
            'parcelas' => $data7,
            'dimensoes' => $data8,
            'cores' => $data9,

        ]);
    }

    public function SomaItens(Request $request){

        $venda = $request->valorItemCompra;

        $itens = DB::table('Compras_Detalhe')->select('cde_qtde', 'cde_valoritem')->where('ven_id','=', $venda)->get();

        $total_valoritem = $itens->sum('cde_valortotal');

        return response()->json(['total' => $total_valoritem]);

    }
}
