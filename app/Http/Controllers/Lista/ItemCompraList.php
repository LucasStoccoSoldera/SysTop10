<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Compras_Detalhe;
use Illuminate\Support\Facades\DB;
use App\Transformers\ItemCompraTransformer;

class ItemCompraList extends Controller
{
    public function listItemCompra(Request $request){

        if($request->ajax()){

            $data = Compras_Detalhe::select('pro_nome', 'cde_qtde', 'dim_descricao', 'cor_nome',
            'cde_valoritem',
            'cde_valortotal')
            ->join('produto', 'compras_detalhe.cde_produto', '=', 'produto.id')
            ->join('dimensoes', 'compras_detalhe.dim_id', '=', 'dimensoes.id')
            ->join('cores', 'compras_detalhe.cor_id', '=', 'cores.id');

            return DataTables::eloquent($data)
            ->setTransformer(new ItemCompraTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
