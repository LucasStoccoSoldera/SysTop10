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
        $ano= Carbon::now()->year;

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
        $ano= Carbon::now()->year;

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
        $ano= Carbon::now()->year;

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
        $ano= Carbon::now()->year;

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
        $ano= Carbon::now()->year;

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
}
