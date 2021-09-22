<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use App\Transformers\ProdutosTransformer;

class ProdutosList extends Controller
{
    public function listProduto(Request $request){

        if($request->ajax()){

            $data = Produto::select('produto.id', 'pro_nome', 'tpp_descricao',
            'pro_precocusto',
            'pro_precovenda')
            ->join('tipoproduto', 'produto.tpp_id', '=', 'tipoproduto.id');

            return  DataTables::eloquent($data)
            ->setTransformer(new ProdutosTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
