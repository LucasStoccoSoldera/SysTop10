<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Material_Base;
use App\Models\TipoProduto;
use App\Models\Pacote;
use App\Models\Cor;
use App\Models\Dimensao;

class ProdutosController extends Controller
{
    public function Produto(){

        $col01 = 'Nome';
        $col02 = 'Tipo';
        $col03 = 'Pedido Mínimo';
        $col04 = 'Terceirização';
        $col05 = 'Cores';
        $col06 = 'Dimensão';
        $col07 = 'Gravura';
        $col08 = 'Adição';
        $col09 = 'Ações';

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Produto::all();
        $data2 = TipoProduto::all();
        $data3 = Material_Base::all();
        $data4 = Pacote::all();
        $data5 = Dimensao::all();
        $data6 = Cor::all();


        return view('dashboard.produtos', [
            'col01' => $col01,
            'col02' => $col02,
            'col03' => $col03,
            'col04' => $col04,
            'col05' => $col05,
            'col06' => $col06,
            'col07' => $col07,
            'col08' => $col08,
            'col09' => $col09,

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
