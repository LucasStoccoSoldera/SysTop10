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

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        if($request->ajax()){

            $data = Produto::query();

            return  DataTables::eloquent($data)
            ->addColumn('action', function($data){

                $btn = '<a href="#" class="btn btn-primary" id="alter" data-id=" '.$data->id.' "><i
                class="tim-icons icon-pencil"></i></a>

               <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data->id.' " data-rota=" '. route('admin.delete.produto') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
