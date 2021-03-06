<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Contas_a_Pagar;
use App\Models\Contas_a_Receber;
use App\Models\Caixa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class FinanceiroController extends Controller
{
    public function Financeiro(){

        $ano = date("Y");
        $mes = date("m");
        $dia = date("d");
        $hora = date("H");
        $minuto = date("i");
        $segundo = date("s");
        $now = date("Y-m-d H:i:s");
        $ontem = Carbon::now()->subDay();
        $semana_passado = Carbon::now()->subWeek();
        $mes_passado = Carbon::now()->subMonth();
        $ano_passado = Carbon::now()->subYear();

        $total_cr_caixa_dia = DB::table('caixa')->where('created_at', '>=', "$ontem")->where('cax_ctreceber', '<>', null)->sum('cax_valor');
        $total_cr_caixa_semana = DB::table('caixa')->where('created_at', '>=', "$semana_passado")->where('cax_ctreceber', '<>', null)->sum('cax_valor');
        $total_cr_caixa_mes = DB::table('caixa')->where('created_at', '>=', "$mes_passado")->where('cax_ctreceber', '<>', null)->sum('cax_valor');

        $total_ct_caixa_dia = DB::table('caixa')->where('created_at', '>=', "$ontem")->where('cax_ctpagar', '<>', null)->sum('cax_valor');
        $total_ct_caixa_semana = DB::table('caixa')->where('created_at', '>=', "$semana_passado")->where('cax_ctpagar', '<>', null)->sum('cax_valor');
        $total_ct_caixa_mes = DB::table('caixa')->where('created_at', '>=', "$mes_passado")->where('cax_ctpagar', '<>', null)->sum('cax_valor');

        $hoje1 = $total_cr_caixa_dia - $total_ct_caixa_dia;
        $hoje2 = DB::table('contas_a_receber')->where('rec_data', '>=', "$ontem")->sum('rec_valor');
        $hoje3 = DB::table('contas_a_pagar')->where('con_data_pag', '>=', "$ontem")->sum('con_valor_final');
        $sem4 = $total_cr_caixa_semana - $total_ct_caixa_semana;
        $sem5 = DB::table('contas_a_receber')->where('rec_data', '>=', "$semana_passado")->sum('rec_valor');
        $sem6 = DB::table('contas_a_pagar')->where('con_data_pag', '>=', "$semana_passado")->sum('con_valor_final');
        $mes7 = $total_cr_caixa_mes - $total_ct_caixa_mes;
        $mes8 = DB::table('contas_a_receber')->where('rec_data', '>=', "$mes_passado")->sum('rec_valor');
        $mes9 = DB::table('contas_a_pagar')->where('con_data_pag', '>=', "$mes_passado")->sum('con_valor_final');

        $data_conta = Contas_a_Pagar::all();
        $data_receber = Contas_a_Receber::all();
        $data_venda = Venda::all();

        return view('dashboard.financas', [

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
