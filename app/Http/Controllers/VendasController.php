<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use App\Models\Dimensao;
use App\Models\Produto;
use App\Models\Logistica;
use App\Models\TipoPagto;
use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Venda_Detalhe;

class VendasController extends Controller
{
    public function Vendas(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Venda::all();

        $data2 = Cor::all();
        $data3 = Dimensao::all();
        $data4 = Produto::all();

        $data6 = Venda_Detalhe::where('ven_id', $request->IDVenda);

        $data7 = TipoPagto::all();
        $data8 = Logistica::all();

        if(isset($id)){
        $data5 = Venda_Detalhe::where('ven_id', $id);

       return  response()->json(['vendas' => $data, 'itensvenda' => $data5, 'itens_ato' => $data6]);

        return view('dashboard.vendas', [

            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,

            'vendas' => $data,
            'cores' => $data2,
            'dimensoes' => $data3,
            'produtos' => $data4,
            'itensvenda' => $data5,
            'itens_ato' => $data6,

            'pagamentos' => $data7,
            'logisticas' => $data8

        ]);
        } else{
            return view('dashboard.vendas', [

                'dado1' => $dado1,
                'dado2' => $dado2,
                'dado3' => $dado3,

                'vendas' => $data,
                'cores' => $data2,
                'dimensoes' => $data3,
                'produtos' => $data4,
                'itens_ato' => $data6,

                'pagamentos' => $data7,
                'logisticas' => $data8

            ]);
        }
    }
}
