<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Estoque;
use App\Transformers\EstoqueTransformer;

class EstoqueList extends Controller
{
    public function listEstoqueProduto(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        if($request->ajax()){

            $data = Estoque::query();

                DataTables::eloquent($data)
                ->toJson();
        }
    }
}
