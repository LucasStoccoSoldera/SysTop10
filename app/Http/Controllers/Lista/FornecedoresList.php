<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Fornecedores;
use App\Models\Produto;

class FornecedoresList extends Controller
{
    public function listFornecedores(){

        $dado1 = Fornecedores::count();
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Fornecedores::limit(25)->get();

        return  response()->json(['fornecedores' => $data]);
    }
}
