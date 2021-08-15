<?php

namespace App\Http\Controllers;

use App\Models\Fornecedores;
use App\Models\Produto;

class FornecedoresController extends Controller
{
    public function Fornecedores(){

        $col01 = 'ID';
        $col02 = 'Nome / Razão';
        $col03 = 'CPF / CNPJ';
        $col04 = 'Telefone';
        $col05 = 'Cidade';
        $col06 = 'Ações';

        $dado1 = Fornecedores::count();
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Fornecedores::limit(25)->get();
        $data2 = Produto::all();

        return view('dashboard.fornecedores', [
            'col01' => $col01,
            'col02' => $col02,
            'col03' => $col03,
            'col04' => $col04,
            'col05' => $col05,
            'col06' => $col06,

            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,

            'fornecedores' => $data,
             'produtos' => $data2
        ]);
    }
}
