<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contas_a_Pagar;
use App\Models\TipoPagto;
use App\Models\Centro_Custo;
use App\Models\Parcelas;
use App\Models\Produto;
use App\Models\Fornecedores;
use App\Models\Compras_Detalhe;

class ContasList extends Controller
{
    public function listContas(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data1 = Contas_a_Pagar::all();
        $data4 = Compras_Detalhe::where('com_id', $request->IDCompra);

        $data7 = Parcelas::all();



        return  response()->json(['contas' => $data1, 'parcelas' => $data7, 'ItensCompra' => $data4]);
    }
}
