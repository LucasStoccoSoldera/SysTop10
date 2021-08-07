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
use Illuminate\Support\Facades\DB;

class ContasController extends Controller
{
    public function Contas(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data1 = Contas_a_Pagar::all();
        $data2 = Centro_Custo::all();
        $data3 = TipoPagto::all();
        $data4 = Compras_Detalhe::where('com_id', $request->IDCompra);

        $data5 = Fornecedores::all();
        $data6 = Produto::all();

        $data7 = Parcelas::all();



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
            'parcelas' => $data7

        ]);
    }

    public function SomaItens(Request $request){

        $venda = $request->valorItemCompra;

        $itens = DB::table('Compras_Detalhe')->select('cde_qtde', 'cde_valoritem')->where('ven_id','=', $venda)->get();

        $total_valoritem = $itens->sum('cde_valortotal');

        return response()->json(['total' => $total_valoritem]);

    }
}
