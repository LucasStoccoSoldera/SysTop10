<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Models\Produto;
use App\Models\Dimensao;
use App\Models\Cor;
use App\Transformers\EstoqueTransformer;

class EstoqueList extends Controller
{
    public function listEstoque(Request $request){


        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Estoque::all();
        $data2 = Produto::all();
        $data3 = Dimensao::all();
        $data4 = Cor::all();


        if($request->ajax()){

            $data = Estoque::all();
            $data2 = Produto::all();

            return  [DataTables::eloquent($data)
            ->setTransformer(new EstoqueTransformer)
            ->addColumn('Ações', function($data){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->make(true)

            ,

                DataTables::eloquent($data2)
                ->setTransformer(new EstoqueTransformer)
                ->make(true)
        ];
        }
    }
}
