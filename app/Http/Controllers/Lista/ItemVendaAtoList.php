<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Venda_Detalhe;
use Illuminate\Support\Facades\DB;
use App\Transformers\ItemVendaTransformer;

class ItemVendaAtoList extends Controller
{
    public function listItemVendaAto(Request $request){

        if(empty($request->id)){
            $data = Venda_Detalhe::select('produto.pro_nome', 'det_qtde', 'dim_descricao', 'cor_nome',
            'det_valor_total')
            ->join('vendas', 'vendas_detalhe.ven_id', '=', 'vendas.id')
            ->join('produto', 'vendas_detalhe.pro_id', '=', 'produto.id')
            ->join('dimensoes', 'vendas_detalhe.dim_id', '=', 'dimensoes.id')
            ->join('cores', 'vendas_detalhe.cor_id', '=', 'cores.id')
            ->where('ven_id', '=', 0);

            return DataTables::eloquent($data)
            ->setTransformer(new ItemVendaTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }

        $data = Venda_Detalhe::select('produto.pro_nome', 'det_qtde', 'dim_descricao', 'cor_nome',
        'det_valor_total')
        ->join('vendas', 'vendas_detalhe.ven_id', '=', 'vendas.id')
        ->join('produto', 'vendas_detalhe.pro_id', '=', 'produto.id')
        ->join('dimensoes', 'vendas_detalhe.dim_id', '=', 'dimensoes.id')
        ->join('cores', 'vendas_detalhe.cor_id', '=', 'cores.id')
        ->where('ven_id', '=', $request->id);

        return DataTables::eloquent($data)
        ->setTransformer(new ItemVendaTransformer)
        ->rawColumns(['action'])
        ->toJson();
    }

        public function listItemVendaAtoBlur(Request $request){

                $data = Venda_Detalhe::select('vendas_detalhe.id', 'pro_nome', 'det_qtde',
                'det_valor_total')
                ->join('venda', 'vendas_detalhe.ven_id', '=', 'venda.id')->where('ven_id', '=', $request->id);

                return DataTables::eloquent($data)
                ->setTransformer(new ItemVendaTransformer)
                ->rawColumns(['action'])
                ->toJson();
            }
    }
