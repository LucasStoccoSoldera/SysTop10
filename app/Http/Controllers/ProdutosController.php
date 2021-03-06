<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Material_Base;
use App\Models\TipoProduto;
use App\Models\Pacote;
use App\Models\Cor;
use App\Models\CorProduto;
use App\Models\Dimensao;
use App\Models\DimensaoProduto;
use App\Models\ExportProduto;
use App\Models\Logistica;
use App\Models\Venda_Detalhe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ProdutosController extends Controller
{
    public function Produto(){

        $ano = date("Y");
        $mes = date("m");
        $dia = date("d");
        $hora = date("H");
        $minuto = date("i");
        $segundo = date("s");
        $now = date("Y-m-d H:i:s");
        $ontem = Carbon::now()->subDay();
        $mes_passado = Carbon::now()->subMonth();
        $ano_passado = Carbon::now()->subYear();

        $dado1 = Produto::count();
        $dado2 = Venda_Detalhe::select(DB::raw("count(pro_id) as pro_id"))->groupBy('pro_id')->having('pro_id', '>', 1)->orderBy('pro_id', 'desc')->first();
        $dado3 = DB::table('produto')->where('pro_promocao', '=', 'Sim')->count();
        $dado3 = str_replace('{"pro_id":', '', $dado3);
        $dado3 = str_replace('}', '', $dado3);

        $data = Produto::all();
        $data2 = TipoProduto::all();
        $data3 = Material_Base::all();
        $data4 = Pacote::all();
        $data5 = Dimensao::all();
        $data6 = Cor::all();
        $data7 = Logistica::all();


        return view('dashboard.produtos', [

            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,

            'produtos' => $data,
            'tipos' => $data2,
            'materiais' => $data3,
            'pacotes' => $data4,
            'dimensoes' => $data5,
            'cores' => $data6,
            'logisticas' => $data7

        ]);
    }

    public function exportProduto(){

        $tabela_inteira = ExportProduto::query();
        $tabela_inteira->delete();

        $produtos = Produto::all();

        foreach ($produtos as $produto){

        $cor_colunas = Schema::getColumnListing('cor_produto');
        $cor_colunas = array_diff($cor_colunas, array("id","pro_id", "created_at", "updated_at"));
        $dimensao_colunas = Schema::getColumnListing('dimensao_produto');
        $dimensao_colunas = array_diff($dimensao_colunas, array("id","pro_id", "created_at", "updated_at"));


        foreach ($cor_colunas as $cor_coluna){

        $cor_coluna = substr($cor_coluna, 2);

        $cor_join = Cor::select('cor_hex_especial')->where('id', '=', $cor_coluna)->first();
        $tipo_join = TipoProduto::select('tpp_descricao')->where('id', '=', $produto->tpp_id)->first();
        $material_join = Material_Base::select('mat_descricao')->where('id', '=', $produto->mat_id)->first();


        $Export = new ExportProduto;
        $Export->pro_id = $produto->id;
        $Export->pro_nome = $produto->pro_nome;
        $Export->tpp_id = $tipo_join->tpp_descricao;
        $Export->log_id = $produto->log_id;
        $Export->mat_id = $material_join->mat_descricao;
        $Export->pro_precocusto = $produto->pro_precocusto;
        $Export->pro_precovenda = $produto->pro_precovenda;
        $Export->pro_promocao = $produto->pro_promocao;
        $Export->pro_pedidominimo = $produto->pro_pedidominimo;
        $Export->pro_foto_path = $produto->pro_foto_path;
        $Export->pro_personalizacao = $produto->pro_personalizacao;
        $Export->pro_terceirizacao = $produto->pro_terceirizacao;
        $Export->pro_descricao = $produto->pro_descricao;
        $Export->pro_cor = $cor_coluna;
        $Export->pro_cor_referencia = $cor_join->cor_hex_especial;
        $Export->pro_dimensao = null;
        $Export->save();
            }

            foreach ($dimensao_colunas as $dimensao_coluna){

                $dimensao_coluna = substr($dimensao_coluna, 2);

                $dimensao_join = Dimensao::select('dim_descricao')->where('id', '=', $dimensao_coluna)->first();
                $tipo_join = TipoProduto::select('tpp_descricao')->where('id', '=', $produto->tpp_id)->first();
                $material_join = Material_Base::select('mat_descricao')->where('id', '=', $produto->mat_id)->first();

                $Export = new ExportProduto;
                $Export->pro_id = $produto->id;
                $Export->pro_nome = $produto->pro_nome;
                $Export->tpp_id = $tipo_join->tpp_descricao;
                $Export->log_id = $produto->log_id;
                $Export->mat_id = $material_join->mat_descricao;
                $Export->pro_precocusto = $produto->pro_precocusto;
                $Export->pro_precovenda = $produto->pro_precovenda;
                $Export->pro_promocao = $produto->pro_promocao;
                $Export->pro_pedidominimo = $produto->pro_pedidominimo;
                $Export->pro_foto_path = $produto->pro_foto_path;
                $Export->pro_personalizacao = $produto->pro_personalizacao;
                $Export->pro_terceirizacao = $produto->pro_terceirizacao;
                $Export->pro_descricao = $produto->pro_descricao;
                $Export->pro_cor = null;
                $Export->pro_cor_referencia = null;
                $Export->pro_dimensao = $dimensao_join->dim_descricao;
                $Export->save();
                    }
        }
        if($Export){
        return response()->json(['status' => 1, 'msg' => 'Exporta????o conclu??da!']);
        }
        else{
            return response()->json(['status' => 0, 'msg' => 'Exporta????o falhou!']);
        }
    }
}
