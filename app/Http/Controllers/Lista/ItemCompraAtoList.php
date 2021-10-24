<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Compras_Detalhe;
use Illuminate\Support\Facades\DB;
use App\Transformers\ItemCompraAtoTransformer;

class ItemCompraAtoList extends Controller
{
    public function listItemCompraAto($id){

        if(empty($id)){
            $data = Compras_Detalhe::select('pro_nome', 'cde_qtde',
            'cde_valoritem',
            'cde_valortotal')
            ->join('produto', 'compras_detalhe.cde_produto', '=', 'produto.id')->where('com_id', '=', 0);

            return DataTables::eloquent($data)
            ->setTransformer(new ItemCompraAtoTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }

            $data = Compras_Detalhe::select('pro_nome', 'cde_qtde',
            'cde_valoritem',
            'cde_valortotal')
            ->join('produto', 'compras_detalhe.cde_produto', '=', 'produto.id')->where('com_id', '=', $id);

            return DataTables::eloquent($data)
            ->setTransformer(new ItemCompraAtoTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }
}
