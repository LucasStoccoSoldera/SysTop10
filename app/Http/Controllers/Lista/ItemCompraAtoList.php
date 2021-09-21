<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Compras_Detalhe;
use App\Transformers\ItemCompraAtoTransformer;

class ItemCompraAtoList extends Controller
{
    public function listItemCompraAto(Request $request){

        if($request->ajax()){

            $data = Compras_Detalhe::select('pro_nome', 'cde_qtde', 'cde_valoritem', 'cde_valortotal')
            ->join('produto', 'compras_detalhe.cde_produto', '=', 'produto.id')->where('com_id', $request->IDCompra);

            return DataTables::eloquent($data)
            ->setTransformer(new ItemCompraAtoTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
