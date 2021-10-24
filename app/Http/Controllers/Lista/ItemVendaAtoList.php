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
    public function listItemVendaAto($id){

        if(empty($id)){
            $data = Venda_Detalhe::select('vendas_detalhe.id', 'pro_nome', 'det_qtde',
            'det_valor_total')
            ->join('produto', 'vendas_detalhe.pro_id', '=', 'produto.id')->where('ven_id', '=', 0);

            return DataTables::eloquent($data)
            ->setTransformer(new ItemVendaTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }

            $data = Venda_Detalhe::select('vendas_detalhe.id', 'pro_nome', 'det_qtde',
            'det_valor_total')
            ->join('produto', 'vendas_detalhe.pro_id', '=', 'produto.id')->where('ven_id', '=', $id);

            return DataTables::eloquent($data)
            ->setTransformer(new ItemVendaTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }
    }
