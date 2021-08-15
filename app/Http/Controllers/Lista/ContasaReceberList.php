<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Contas_a_Receber;

class ContasaReceberList extends Controller
{
    public function listContasaReceber(){


        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Contas_a_Receber::all();

        return  response()->json(['creditos' => $data]);
    }
}
