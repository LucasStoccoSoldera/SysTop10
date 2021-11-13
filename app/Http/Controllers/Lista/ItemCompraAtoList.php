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
    public function listItemCompraAto(Request $request){

        if(empty($request->id)){
            $data = Compras_Detalhe::select('cde_produto', 'cde_qtde',
            'cde_valoritem',
            'cde_valortotal')
            ->join('compra', 'compras_detalhe.com_id', '=', 'compra.id')->where('com_id', '=', 0);

            return DataTables::eloquent($data)
            ->setTransformer(new ItemCompraAtoTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }


        $data = Compras_Detalhe::select('cde_produto', 'cde_qtde',
        'cde_valoritem',
        'cde_valortotal')
        ->join('compra', 'compras_detalhe.com_id', '=', 'compra.id')->where('com_id', '=', $request->id);

        return DataTables::eloquent($data)
        ->setTransformer(new ItemCompraAtoTransformer)
        ->rawColumns(['action'])
        ->toJson();
        }

        public function listItemCompraAtoBlur(Request $request){

                $data = Compras_Detalhe::select('cde_produto', 'cde_qtde',
                'cde_valoritem',
                'cde_valortotal')
                ->join('compra', 'compras_detalhe.com_id', '=', 'compra.id')->where('com_id', '=', $request->id);

                return DataTables::eloquent($data)
                ->setTransformer(new ItemCompraAtoTransformer)
                ->rawColumns(['action'])
                ->toJson();
            }
}
