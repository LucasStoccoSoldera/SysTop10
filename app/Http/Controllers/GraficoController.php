<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\Venda_Detalhe;
use App\Models\Contas_a_Pagar;
use App\Models\Contas_a_Receber;
use App\Models\Caixa;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{

    public function cliente(){


        $sql_jan = DB::table('cliente')->whereMonth('created_at',  '1')->count();
        $sql_fev = DB::table('cliente')->whereMonth('created_at',  '2')->count();
        $sql_mar = DB::table('cliente')->whereMonth('created_at',  '3')->count();
        $sql_abr = DB::table('cliente')->whereMonth('created_at',  '4')->count();
        $sql_mai = DB::table('cliente')->whereMonth('created_at',  '5')->count();
        $sql_jun = DB::table('cliente')->whereMonth('created_at',  '6')->count();
        $sql_jul = DB::table('cliente')->whereMonth('created_at',  '7')->count();
        $sql_ago = DB::table('cliente')->whereMonth('created_at',  '8')->count();
        $sql_set = DB::table('cliente')->whereMonth('created_at',  '9')->count();
        $sql_out = DB::table('cliente')->whereMonth('created_at',  '10')->count();
        $sql_nov = DB::table('cliente')->whereMonth('created_at',  '11')->count();
        $sql_dez = DB::table('cliente')->whereMonth('created_at',  '12')->count();

        return response()->json(['grafico' => [$sql_jan, $sql_fev, $sql_mar, $sql_abr, $sql_mai,
        $sql_jun, $sql_jul, $sql_ago, $sql_set, $sql_out, $sql_nov, $sql_dez] ]);

    }

    public function financeiro(){


        $sql_jan = DB::table('caixa')->whereMonth('created_at',  '1')->sum('cax_valor');
        $sql_fev = DB::table('caixa')->whereMonth('created_at',  '2')->sum('cax_valor');
        $sql_mar = DB::table('caixa')->whereMonth('created_at',  '3')->sum('cax_valor');
        $sql_abr = DB::table('caixa')->whereMonth('created_at',  '4')->sum('cax_valor');
        $sql_mai = DB::table('caixa')->whereMonth('created_at',  '5')->sum('cax_valor');
        $sql_jun = DB::table('caixa')->whereMonth('created_at',  '6')->sum('cax_valor');
        $sql_jul = DB::table('caixa')->whereMonth('created_at',  '7')->sum('cax_valor');
        $sql_ago = DB::table('caixa')->whereMonth('created_at',  '8')->sum('cax_valor');
        $sql_set = DB::table('caixa')->whereMonth('created_at',  '9')->sum('cax_valor');
        $sql_out = DB::table('caixa')->whereMonth('created_at',  '10')->sum('cax_valor');
        $sql_nov = DB::table('caixa')->whereMonth('created_at',  '11')->sum('cax_valor');
        $sql_dez = DB::table('caixa')->whereMonth('created_at',  '12')->sum('cax_valor');

        return response()->json(['grafico' => [$sql_jan, $sql_fev, $sql_mar, $sql_abr, $sql_mai,
        $sql_jun, $sql_jul, $sql_ago, $sql_set, $sql_out, $sql_nov, $sql_dez] ]);
    }

    public function contas_a_pagar(){


        $sql_jan = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '1')->sum('con_valor_final');
        $sql_fev = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '2')->sum('con_valor_final');
        $sql_mar = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '3')->sum('con_valor_final');
        $sql_abr = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '4')->sum('con_valor_final');
        $sql_mai = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '5')->sum('con_valor_final');
        $sql_jun = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '6')->sum('con_valor_final');
        $sql_jul = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '7')->sum('con_valor_final');
        $sql_ago = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '8')->sum('con_valor_final');
        $sql_set = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '9')->sum('con_valor_final');
        $sql_out = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '10')->sum('con_valor_final');
        $sql_nov = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '11')->sum('con_valor_final');
        $sql_dez = DB::table('contas_a_pagar')->whereMonth('con_data_venc', '12')->sum('con_valor_final');

        return response()->json(['grafico' => [$sql_jan, $sql_fev, $sql_mar, $sql_abr, $sql_mai,
        $sql_jun, $sql_jul, $sql_ago, $sql_set, $sql_out, $sql_nov, $sql_dez] ]);
    }

    public function contas_a_receber(){


        $sql_jan = DB::table('contas_a_receber')->whereMonth('rec_data',  '1')->sum('rec_valor_final');
        $sql_fev = DB::table('contas_a_receber')->whereMonth('rec_data',  '2')->sum('rec_valor_final');
        $sql_mar = DB::table('contas_a_receber')->whereMonth('rec_data',  '3')->sum('rec_valor_final');
        $sql_abr = DB::table('contas_a_receber')->whereMonth('rec_data',  '4')->sum('rec_valor_final');
        $sql_mai = DB::table('contas_a_receber')->whereMonth('rec_data',  '5')->sum('rec_valor_final');
        $sql_jun = DB::table('contas_a_receber')->whereMonth('rec_data',  '6')->sum('rec_valor_final');
        $sql_jul = DB::table('contas_a_receber')->whereMonth('rec_data',  '7')->sum('rec_valor_final');
        $sql_ago = DB::table('contas_a_receber')->whereMonth('rec_data',  '8')->sum('rec_valor_final');
        $sql_set = DB::table('contas_a_receber')->whereMonth('rec_data',  '9')->sum('rec_valor_final');
        $sql_out = DB::table('contas_a_receber')->whereMonth('rec_data',  '10')->sum('rec_valor_final');
        $sql_nov = DB::table('contas_a_receber')->whereMonth('rec_data',  '11')->sum('rec_valor_final');
        $sql_dez = DB::table('contas_a_receber')->whereMonth('rec_data',  '12')->sum('rec_valor_final');

        return response()->json(['grafico' => [$sql_jan, $sql_fev, $sql_mar, $sql_abr, $sql_mai,
        $sql_jun, $sql_jul, $sql_ago, $sql_set, $sql_out, $sql_nov, $sql_dez] ]);
    }

    public function vendas(){


        $sql_jan = DB::table('vendas')->whereMonth('created_at',  '1')->count();
        $sql_fev = DB::table('vendas')->whereMonth('created_at',  '2')->count();
        $sql_mar = DB::table('vendas')->whereMonth('created_at',  '3')->count();
        $sql_abr = DB::table('vendas')->whereMonth('created_at',  '4')->count();
        $sql_mai = DB::table('vendas')->whereMonth('created_at',  '5')->count();
        $sql_jun = DB::table('vendas')->whereMonth('created_at',  '6')->count();
        $sql_jul = DB::table('vendas')->whereMonth('created_at',  '7')->count();
        $sql_ago = DB::table('vendas')->whereMonth('created_at',  '8')->count();
        $sql_set = DB::table('vendas')->whereMonth('created_at',  '9')->count();
        $sql_out = DB::table('vendas')->whereMonth('created_at',  '10')->count();
        $sql_nov = DB::table('vendas')->whereMonth('created_at',  '11')->count();
        $sql_dez = DB::table('vendas')->whereMonth('created_at',  '12')->count();

        return response()->json(['grafico' => [$sql_jan, $sql_fev, $sql_mar, $sql_abr, $sql_mai,
        $sql_jun, $sql_jul, $sql_ago, $sql_set, $sql_out, $sql_nov, $sql_dez] ]);
    }


    public function cliente_bar(){

        $now = Carbon::now();
        $mes_1_antes_calc = $now->subMonth()->month;
        $now = Carbon::now();
        $mes_2_antes_calc= $now->subMonths(2)->month;
        $now = Carbon::now();
        $mes_1_depois_calc = $now->addMonth()->month;
        $now = Carbon::now();
        $mes_2_depois_calc = $now->addMonths(2)->month;
        $now = Carbon::now();
        $mes_3_depois_calc = $now->addMonths(3)->month;
        $now = Carbon::now()->month;

        $mes_1_antes = $mes_1_antes_calc;
        $mes_2_antes = $mes_2_antes_calc;
        $mes_1_depois = $mes_1_depois_calc;
        $mes_2_depois = $mes_2_depois_calc;
        $mes_3_depois = $mes_3_depois_calc;


        $months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Abr',5=>'Mai',6=>'Jun',7=>'Jul',8=>'Ago',9=>'Set',10=>'Out',11=>'Nov',12=>'Dez');
        $nome_mes_agora =  $months[(int)$now];
        $nome_mes_1_antes =  $months[(int)$mes_1_antes];
        $nome_mes_2_antes =  $months[(int)$mes_2_antes];
        $nome_mes_1_depois =  $months[(int)$mes_1_depois];
        $nome_mes_2_depois =  $months[(int)$mes_2_depois];
        $nome_mes_3_depois =  $months[(int)$mes_3_depois];

        $now_sql = DB::table('cliente')->whereMonth('created_at',  $now)->count();
        $mes_1_antes_sql = DB::table('cliente')->whereMonth('created_at',  $mes_1_antes)->count();
        $mes_2_antes_sql = DB::table('cliente')->whereMonth('created_at',  $mes_2_antes)->count();
        $mes_1_depois_sql = DB::table('cliente')->whereMonth('created_at',  $mes_1_depois)->count();
        $mes_2_depois_sql = DB::table('cliente')->whereMonth('created_at',  $mes_2_depois)->count();
        $mes_3_depois_sql = DB::table('cliente')->whereMonth('created_at',  $mes_3_depois)->count();

        return response()->json(['legenda' =>[$nome_mes_1_antes, $nome_mes_2_antes, $nome_mes_agora, $nome_mes_1_depois, $nome_mes_2_depois, $nome_mes_3_depois], 'grafico' => [$now_sql, $mes_1_antes_sql, $mes_2_antes_sql, $mes_1_depois_sql, $mes_2_depois_sql,
        $mes_3_depois_sql] ]);
    }

    public function contas_bar(){

        $now = Carbon::now();
        $mes_1_antes_calc = $now->subMonth()->month;
        $now = Carbon::now();
        $mes_2_antes_calc= $now->subMonths(2)->month;
        $now = Carbon::now();
        $mes_1_depois_calc = $now->addMonth()->month;
        $now = Carbon::now();
        $mes_2_depois_calc = $now->addMonths(2)->month;
        $now = Carbon::now();
        $mes_3_depois_calc = $now->addMonths(3)->month;
        $now = Carbon::now()->month;

        $mes_1_antes = $mes_1_antes_calc;
        $mes_2_antes = $mes_2_antes_calc;
        $mes_1_depois = $mes_1_depois_calc;
        $mes_2_depois = $mes_2_depois_calc;
        $mes_3_depois = $mes_3_depois_calc;

        $months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Abr',5=>'Mai',6=>'Jun',7=>'Jul',8=>'Ago',9=>'Set',10=>'Out',11=>'Nov',12=>'Dez');
        $nome_mes_agora =  $months[(int)$now];
        $nome_mes_1_antes =  $months[(int)$mes_1_antes];
        $nome_mes_2_antes =  $months[(int)$mes_2_antes];
        $nome_mes_1_depois =  $months[(int)$mes_1_depois];
        $nome_mes_2_depois =  $months[(int)$mes_2_depois];
        $nome_mes_3_depois =  $months[(int)$mes_3_depois];

        $now_sql = DB::table('contas_a_pagar')->whereMonth('con_data_venc', $now)->sum('con_valor_final');
        $mes_1_antes_sql = DB::table('contas_a_pagar')->whereMonth('con_data_venc', $mes_1_antes)->sum('con_valor_final');
        $mes_2_antes_sql = DB::table('contas_a_pagar')->whereMonth('con_data_venc', $mes_2_antes)->sum('con_valor_final');
        $mes_1_depois_sql = DB::table('contas_a_pagar')->whereMonth('con_data_venc', $mes_1_depois)->sum('con_valor_final');
        $mes_2_depois_sql = DB::table('contas_a_pagar')->whereMonth('con_data_venc', $mes_2_depois)->sum('con_valor_final');
        $mes_3_depois_sql = DB::table('contas_a_pagar')->whereMonth('con_data_venc', $mes_3_depois)->sum('con_valor_final');

        return response()->json(['legenda' =>[$nome_mes_1_antes, $nome_mes_2_antes, $nome_mes_agora, $nome_mes_1_depois, $nome_mes_2_depois, $nome_mes_3_depois], 'grafico' => [$now_sql, $mes_1_antes_sql, $mes_2_antes_sql, $mes_1_depois_sql, $mes_2_depois_sql,
        $mes_3_depois_sql] ]);
    }

    public function receber_bar(){

        $now = Carbon::now();
        $mes_1_antes_calc = $now->subMonth()->month;
        $now = Carbon::now();
        $mes_2_antes_calc= $now->subMonths(2)->month;
        $now = Carbon::now();
        $mes_1_depois_calc = $now->addMonth()->month;
        $now = Carbon::now();
        $mes_2_depois_calc = $now->addMonths(2)->month;
        $now = Carbon::now();
        $mes_3_depois_calc = $now->addMonths(3)->month;
        $now = Carbon::now()->month;

        $mes_1_antes = $mes_1_antes_calc;
        $mes_2_antes = $mes_2_antes_calc;
        $mes_1_depois = $mes_1_depois_calc;
        $mes_2_depois = $mes_2_depois_calc;
        $mes_3_depois = $mes_3_depois_calc;


        $months = array (1=>'Jan',2=>'Fev',3=>'Mar',4=>'Abr',5=>'Mai',6=>'Jun',7=>'Jul',8=>'Ago',9=>'Set',10=>'Out',11=>'Nov',12=>'Dez');
        $nome_mes_agora =  $months[(int)$now];
        $nome_mes_1_antes =  $months[(int)$mes_1_antes];
        $nome_mes_2_antes =  $months[(int)$mes_2_antes];
        $nome_mes_1_depois =  $months[(int)$mes_1_depois];
        $nome_mes_2_depois =  $months[(int)$mes_2_depois];
        $nome_mes_3_depois =  $months[(int)$mes_3_depois];

        $now_sql = DB::table('contas_a_receber')->whereMonth('rec_data',  $now)->sum('rec_valor_final');
        $mes_1_antes_sql = DB::table('contas_a_receber')->whereMonth('rec_data',  $mes_1_antes)->sum('rec_valor_final');
        $mes_2_antes_sql = DB::table('contas_a_receber')->whereMonth('rec_data',  $mes_2_antes)->sum('rec_valor_final');
        $mes_1_depois_sql = DB::table('contas_a_receber')->whereMonth('rec_data',  $mes_1_depois)->sum('rec_valor_final');
        $mes_2_depois_sql = DB::table('contas_a_receber')->whereMonth('rec_data',  $mes_2_depois)->sum('rec_valor_final');
        $mes_3_depois_sql = DB::table('contas_a_receber')->whereMonth('rec_data',  $mes_3_depois)->sum('rec_valor_final');

        return response()->json(['legenda' =>[$nome_mes_1_antes, $nome_mes_2_antes, $nome_mes_agora, $nome_mes_1_depois, $nome_mes_2_depois, $nome_mes_3_depois], 'grafico' => [$now_sql, $mes_1_antes_sql, $mes_2_antes_sql, $mes_1_depois_sql, $mes_2_depois_sql,
        $mes_3_depois_sql] ]);
    }


}
