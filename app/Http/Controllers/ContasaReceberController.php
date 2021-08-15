<?php

namespace App\Http\Controllers;

use App\Models\Contas_a_Receber;
use App\Models\TipoPagto;

class ContasaReceberController extends Controller
{
    public function ContasaReceber(){


        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Contas_a_Receber::all();
        $data1 = TipoPagto::all();

        return view('dashboard.contasareceber', [

            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,
            'creditos' => $data,
            'pagamentos' => $data1
        ]);
    }
}
