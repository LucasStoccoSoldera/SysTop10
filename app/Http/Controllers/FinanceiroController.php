<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Contas_a_Pagar;
use App\Models\Contas_a_Receber;
use App\Models\Caixa;

class FinanceiroController extends Controller
{
    public function Financeiro(){

        $col01 = 'teste';
        $col02 = 'teste';
        $col03 = 'teste';
        $col04 = 'teste';
        $lineCol01 = 'teste';
        $lineCol02 = 'teste';
        $lineCol03 = 'teste';
        $lineCol04 = 'teste';

        $hoje1 = 'teste';
        $hoje2 = 'teste';
        $hoje3 = 'teste';
        $sem4 = 'teste';
        $sem5 = 'teste';
        $sem6 = 'teste';
        $mes7 = 'teste';
        $mes8 = 'teste';
        $mes9 = 'teste';

        $data_conta = Contas_a_Pagar::all();
        $data_receber = Contas_a_Receber::all();
        $data_venda = Venda::all();

        return view('dashboard.financas', [
            'col01' => $col01,
            'col02' => $col02,
            'col03' => $col03,
            'col04' => $col04,
            'lineCol01' => $lineCol01,
            'lineCol02' => $lineCol02,
            'lineCol03' => $lineCol03,
            'lineCol04' => $lineCol04,

            'hoje1' => $hoje1,
            'hoje2' => $hoje2,
            'hoje3' => $hoje3,
            'sem4' => $sem4,
            'sem5' => $sem5,
            'sem6' => $sem6,
            'mes7' => $mes7,
            'mes8' => $mes8,
            'mes9' => $mes9,

            'contas' => $data_conta,
            'creditos' => $data_receber,
            'vendas' => $data_venda

        ]);
    }
}
