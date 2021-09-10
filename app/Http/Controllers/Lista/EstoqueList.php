<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Transformers\EstoqueTransformer;

class EstoqueList extends Controller
{
    public function listEstoque(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        if($request->ajax()){

            $data = Estoque::query();

            return  DataTables::eloquent($data)
            ->addColumn('action', function($data){

                $btn = '<a href="#" class="btn btn-primary" id="alter" data-id=" '.$data->id.' "><i
                class="tim-icons icon-pencil"></i></a>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
