<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\Material_Base;
use App\Models\TipoProduto;
use App\Models\Pacote;
use App\Models\Cor;
use App\Models\Dimensao;
use App\Transformers\ProdutosTransformer;
use App\Transformers\TipoProdutoTransformer;
use App\Transformers\MaterialTransformer;
use App\Transformers\DimensaoTransformer;
use App\Transformers\CorTransformer;
use App\Transformers\PacoteTransformer;

class ProdutosList extends Controller
{
    public function listProduto(Request $request){

        if($request->ajax()){

            $data = Produto::select('produto.id', 'pro_nome', 'tpp_descricao', 'pro_precocusto', 'pro_precovenda')
            ->join('tipoproduto', 'produto.tpp_id', '=', 'tipoproduto.id');

            return  DataTables::eloquent($data)
            ->setTransformer(new ProdutosTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
