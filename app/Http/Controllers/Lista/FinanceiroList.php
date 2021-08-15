<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Models\Contas_a_Pagar;
use App\Models\Contas_a_Receber;
use App\Models\Caixa;

class FinanceiroList extends Controller
{
    public function listFinanceiro(){

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
    }
}
