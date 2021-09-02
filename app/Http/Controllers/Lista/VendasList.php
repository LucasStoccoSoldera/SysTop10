<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Venda;
use App\Transformers\VendasTransformer;

class VendasList extends Controller
{
    public function listVendas(Request $request){

        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

            if($request->ajax()){

                $data = Venda::query();

                return  DataTables::eloquent($data)
                ->addColumn('action', function($data){

                    $btn = '<a href="#" class="btn btn-primary" id="view"><i
                    class="tim-icons icon-pencil"></i></a>';
                    return $btn;
                })

                ->rawColumns(['action'])
                ->toJson();
        }
    }
}
