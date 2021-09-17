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

                    $btn = '<button type="button" class="btn btn-primary visu" id="visu-pro"
                    name="visu-produto" data-id="'.$data->id.'"
                   ><i
                    class="tim-icons icon-chart-pie-36"></i></button>

                    <a href="#" class="btn btn-primary alter-min" data-id= '.$data->id.'"><i
                    class="tim-icons icon-pencil"></i></a>

                   <button type="button" class="btn btn-primary red-min" id="excluir-ven"
                    name="excluir-venda" data-id="'.$data->id.'" data-rota="'. route('admin.delete.venda') .'"
                   ><i
                    class="tim-icons icon-simple-remove"></i></button>';
                    return $btn;
                })

                ->rawColumns(['action'])
                ->toJson();
        }
    }
}
