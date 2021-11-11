<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Transformers\EstoqueTransformer;

class EstoqueProdutoList extends Controller
{
    public function listEstoqueProduto(Request $request){

        if($request->ajax()){

            $data = Estoque::select('pro_id','pro_nome', 'est_qtde', 'est_status')
            ->join('produto', 'estoque.pro_id', '=', 'produto.id')->orderBy('est_data');

            return DataTables::eloquent($data)
                ->toJson();
        }
    }
}
