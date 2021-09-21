<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estoque;
use Illuminate\Support\Facades\DB;
use App\Transformers\EstoqueTransformer;

class EstoqueList extends Controller
{
    public function listEstoque(Request $request){

        if($request->ajax()){

            $data = Estoque::select('pro_id', 'est_qtde', 'dim_descricao', 'cor_nome',
            DB::raw("DATE_FORMAT(produto.created_at, '%d/%m/%Y %H:%i') as created_at"))
            ->join('produto', 'estoque.pro_id', '=', 'produto.id')
            ->join('dimensoes', 'estoque.dim_id', '=', 'dimensoes.id')
            ->join('cores', 'estoque.cor_id', '=', 'cores.id');

            return  DataTables::eloquent($data)
            ->setTransformer(new EstoqueTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
