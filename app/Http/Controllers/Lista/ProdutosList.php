<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Material_Base;
use App\Models\TipoProduto;
use App\Models\Pacote;
use App\Models\Cor;
use App\Models\Dimensao;

class ProdutosList extends Controller
{
    public function listProduto(){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Produto::all();
        $data2 = TipoProduto::all();
        $data3 = Material_Base::all();
        $data4 = Pacote::all();
        $data5 = Dimensao::all();
        $data6 = Cor::all();


        return  response()->json(['produtos' => $data, 'tipos' => $data2, 'materiais' => $data3, 'pacotes' => $data4, 'dimensoes' => $data5, 'cores' => $data6]);
    }
}
