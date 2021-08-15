<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Venda_Detalhe;

class VendasList extends Controller
{
    public function listVendas(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Venda::all();
        $data6 = Venda_Detalhe::where('ven_id', $request->IDVenda);

        if(isset($id)){
        $data5 = Venda_Detalhe::where('ven_id', $id);

       return  response()->json(['vendas' => $data, 'itensvenda' => $data5, 'itens_ato' => $data6]);

       return  response()->json(['vendas' => $data, 'itensvenda' => $data5, 'itens_ato' => $data6]);
        } else{
            return  response()->json(['vendas' => $data, 'itens_ato' => $data6]);
        }
    }
}
