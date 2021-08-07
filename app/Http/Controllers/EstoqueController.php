<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Dimensao;
use App\Models\Cor;

class EstoqueController extends Controller
{
    public function Estoque(){


        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

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
