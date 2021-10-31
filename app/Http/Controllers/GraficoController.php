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
        $ano = Carbon::now()->year;
        $jan = "$ano -01-01 and $ano -01-31";
        $fev = "$ano -02-01 and $ano -02-28";
        $mar = "$ano -03-01 and $ano -03-31";
        $abr = "$ano -04-01 and $ano -04-30";
        $mai = "$ano -05-01 and $ano -05-31";
        $jun = "$ano -06-01 and $ano -06-30";
        $jul = "$ano -07-01 and $ano -07-31";
        $ago = "$ano -08-01 and $ano -08-31";
        $set = "$ano -09-01 and $ano -09-30";
        $out = "$ano -10-01 and $ano -10-31";
        $nov = "$ano -11-01 and $ano -11-30";
        $dez = "$ano -12-01 and $ano -12-31";

        $sql_jan = DB::table('cliente')->where('created_at', 'between', "$jan")->count();
        $sql_fev = DB::table('cliente')->where('created_at', 'between', "$fev")->count();
        $sql_mar = DB::table('cliente')->where('created_at', 'between', "$mar")->count();
        $sql_abr = DB::table('cliente')->where('created_at', 'between', "$abr")->count();
        $sql_mai = DB::table('cliente')->where('created_at', 'between', "$mai")->count();
        $sql_jun = DB::table('cliente')->where('created_at', 'between', "$jun")->count();
        $sql_jul = DB::table('cliente')->where('created_at', 'between', "$jul")->count();
        $sql_ago = DB::table('cliente')->where('created_at', 'between', "$ago")->count();
        $sql_set = DB::table('cliente')->where('created_at', 'between', "$set")->count();
        $sql_out = DB::table('cliente')->where('created_at', 'between', "$out")->count();
        $sql_nov = DB::table('cliente')->where('created_at', 'between', "$nov")->count();
        $sql_dez = DB::table('cliente')->where('created_at', 'between', "$dez")->count();

        return response()->json(['grafico' => [$sql_jan, $sql_fev, $sql_mar, $sql_abr, $sql_mai,
        $sql_jun, $sql_jul, $sql_ago, $sql_set, $sql_out, $sql_nov, $sql_dez] ]);

    }

    public function financeiro(){
        $ano = Carbon::now()->year;
        $jan = "$ano -01-01 and $ano -01-31";
        $fev = "$ano -02-01 and $ano -02-28";
        $mar = "$ano -03-01 and $ano -03-31";
        $abr = "$ano -04-01 and $ano -04-30";
        $mai = "$ano -05-01 and $ano -05-31";
        $jun = "$ano -06-01 and $ano -06-30";
        $jul = "$ano -07-01 and $ano -07-31";
        $ago = "$ano -08-01 and $ano -08-31";
        $set = "$ano -09-01 and $ano -09-30";
        $out = "$ano -10-01 and $ano -10-31";
        $nov = "$ano -11-01 and $ano -11-30";
        $dez = "$ano -12-01 and $ano -12-31";

        $sql_jan = DB::table('caixa')->where('created_at', 'between', "$jan")->sum('cax_valor');
        $sql_fev = DB::table('caixa')->where('created_at', 'between', "$fev")->sum('cax_valor');
        $sql_mar = DB::table('caixa')->where('created_at', 'between', "$mar")->sum('cax_valor');
        $sql_abr = DB::table('caixa')->where('created_at', 'between', "$abr")->sum('cax_valor');
        $sql_mai = DB::table('caixa')->where('created_at', 'between', "$mai")->sum('cax_valor');
        $sql_jun = DB::table('caixa')->where('created_at', 'between', "$jun")->sum('cax_valor');
        $sql_jul = DB::table('caixa')->where('created_at', 'between', "$jul")->sum('cax_valor');
        $sql_ago = DB::table('caixa')->where('created_at', 'between', "$ago")->sum('cax_valor');
        $sql_set = DB::table('caixa')->where('created_at', 'between', "$set")->sum('cax_valor');
        $sql_out = DB::table('caixa')->where('created_at', 'between', "$out")->sum('cax_valor');
        $sql_nov = DB::table('caixa')->where('created_at', 'between', "$nov")->sum('cax_valor');
        $sql_dez = DB::table('caixa')->where('created_at', 'between', "$dez")->sum('cax_valor');

        return response()->json(['grafico' => [$sql_jan, $sql_fev, $sql_mar, $sql_abr, $sql_mai,
        $sql_jun, $sql_jul, $sql_ago, $sql_set, $sql_out, $sql_nov, $sql_dez] ]);
    }

    public function contas_a_pagar(){
        $ano = Carbon::now()->year;
        $jan = "$ano -01-01 and $ano -01-31";
        $fev = "$ano -02-01 and $ano -02-28";
        $mar = "$ano -03-01 and $ano -03-31";
        $abr = "$ano -04-01 and $ano -04-30";
        $mai = "$ano -05-01 and $ano -05-31";
        $jun = "$ano -06-01 and $ano -06-30";
        $jul = "$ano -07-01 and $ano -07-31";
        $ago = "$ano -08-01 and $ano -08-31";
        $set = "$ano -09-01 and $ano -09-30";
        $out = "$ano -10-01 and $ano -10-31";
        $nov = "$ano -11-01 and $ano -11-30";
        $dez = "$ano -12-01 and $ano -12-31";

        $sql_jan = DB::table('contas_a_pagar')->where('created_at', 'between', "$jan")->sum('con_valor_final');
        $sql_fev = DB::table('contas_a_pagar')->where('created_at', 'between', "$fev")->sum('con_valor_final');
        $sql_mar = DB::table('contas_a_pagar')->where('created_at', 'between', "$mar")->sum('con_valor_final');
        $sql_abr = DB::table('contas_a_pagar')->where('created_at', 'between', "$abr")->sum('con_valor_final');
        $sql_mai = DB::table('contas_a_pagar')->where('created_at', 'between', "$mai")->sum('con_valor_final');
        $sql_jun = DB::table('contas_a_pagar')->where('created_at', 'between', "$jun")->sum('con_valor_final');
        $sql_jul = DB::table('contas_a_pagar')->where('created_at', 'between', "$jul")->sum('con_valor_final');
        $sql_ago = DB::table('contas_a_pagar')->where('created_at', 'between', "$ago")->sum('con_valor_final');
        $sql_set = DB::table('contas_a_pagar')->where('created_at', 'between', "$set")->sum('con_valor_final');
        $sql_out = DB::table('contas_a_pagar')->where('created_at', 'between', "$out")->sum('con_valor_final');
        $sql_nov = DB::table('contas_a_pagar')->where('created_at', 'between', "$nov")->sum('con_valor_final');
        $sql_dez = DB::table('contas_a_pagar')->where('created_at', 'between', "$dez")->sum('con_valor_final');

        return response()->json(['grafico' => [$sql_jan, $sql_fev, $sql_mar, $sql_abr, $sql_mai,
        $sql_jun, $sql_jul, $sql_ago, $sql_set, $sql_out, $sql_nov, $sql_dez] ]);
    }

    public function contas_a_receber(){
        $ano = Carbon::now()->year;
        $jan = "$ano -01-01 and $ano -01-31";
        $fev = "$ano -02-01 and $ano -02-28";
        $mar = "$ano -03-01 and $ano -03-31";
        $abr = "$ano -04-01 and $ano -04-30";
        $mai = "$ano -05-01 and $ano -05-31";
        $jun = "$ano -06-01 and $ano -06-30";
        $jul = "$ano -07-01 and $ano -07-31";
        $ago = "$ano -08-01 and $ano -08-31";
        $set = "$ano -09-01 and $ano -09-30";
        $out = "$ano -10-01 and $ano -10-31";
        $nov = "$ano -11-01 and $ano -11-30";
        $dez = "$ano -12-01 and $ano -12-31";

        $sql_jan = DB::table('contas_a_receber')->where('created_at', 'between', "$jan")->sum('rec_valor_final');
        $sql_fev = DB::table('contas_a_receber')->where('created_at', 'between', "$fev")->sum('rec_valor_final');
        $sql_mar = DB::table('contas_a_receber')->where('created_at', 'between', "$mar")->sum('rec_valor_final');
        $sql_abr = DB::table('contas_a_receber')->where('created_at', 'between', "$abr")->sum('rec_valor_final');
        $sql_mai = DB::table('contas_a_receber')->where('created_at', 'between', "$mai")->sum('rec_valor_final');
        $sql_jun = DB::table('contas_a_receber')->where('created_at', 'between', "$jun")->sum('rec_valor_final');
        $sql_jul = DB::table('contas_a_receber')->where('created_at', 'between', "$jul")->sum('rec_valor_final');
        $sql_ago = DB::table('contas_a_receber')->where('created_at', 'between', "$ago")->sum('rec_valor_final');
        $sql_set = DB::table('contas_a_receber')->where('created_at', 'between', "$set")->sum('rec_valor_final');
        $sql_out = DB::table('contas_a_receber')->where('created_at', 'between', "$out")->sum('rec_valor_final');
        $sql_nov = DB::table('contas_a_receber')->where('created_at', 'between', "$nov")->sum('rec_valor_final');
        $sql_dez = DB::table('contas_a_receber')->where('created_at', 'between', "$dez")->sum('rec_valor_final');

        return response()->json(['grafico' => [$sql_jan, $sql_fev, $sql_mar, $sql_abr, $sql_mai,
        $sql_jun, $sql_jul, $sql_ago, $sql_set, $sql_out, $sql_nov, $sql_dez] ]);
    }

    public function vendas(){
        $ano = Carbon::now()->year;
        $jan = "$ano -01-01 and $ano -01-31";
        $fev = "$ano -02-01 and $ano -02-28";
        $mar = "$ano -03-01 and $ano -03-31";
        $abr = "$ano -04-01 and $ano -04-30";
        $mai = "$ano -05-01 and $ano -05-31";
        $jun = "$ano -06-01 and $ano -06-30";
        $jul = "$ano -07-01 and $ano -07-31";
        $ago = "$ano -08-01 and $ano -08-31";
        $set = "$ano -09-01 and $ano -09-30";
        $out = "$ano -10-01 and $ano -10-31";
        $nov = "$ano -11-01 and $ano -11-30";
        $dez = "$ano -12-01 and $ano -12-31";

        $sql_jan = DB::table('cliente')->where('created_at', 'between', "$jan")->count();
        $sql_fev = DB::table('cliente')->where('created_at', 'between', "$fev")->count();
        $sql_mar = DB::table('cliente')->where('created_at', 'between', "$mar")->count();
        $sql_abr = DB::table('cliente')->where('created_at', 'between', "$abr")->count();
        $sql_mai = DB::table('cliente')->where('created_at', 'between', "$mai")->count();
        $sql_jun = DB::table('cliente')->where('created_at', 'between', "$jun")->count();
        $sql_jul = DB::table('cliente')->where('created_at', 'between', "$jul")->count();
        $sql_ago = DB::table('cliente')->where('created_at', 'between', "$ago")->count();
        $sql_set = DB::table('cliente')->where('created_at', 'between', "$set")->count();
        $sql_out = DB::table('cliente')->where('created_at', 'between', "$out")->count();
        $sql_nov = DB::table('cliente')->where('created_at', 'between', "$nov")->count();
        $sql_dez = DB::table('cliente')->where('created_at', 'between', "$dez")->count();

        return response()->json(['grafico' => [$sql_jan, $sql_fev, $sql_mar, $sql_abr, $sql_mai,
        $sql_jun, $sql_jul, $sql_ago, $sql_set, $sql_out, $sql_nov, $sql_dez] ]);
    }
}
