<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Transportadora;
use App\Transformers\TransportadoraTransformer;

class TransportadoraList extends Controller
{
    public function listTransportadora(Request $request){

        if($request->ajax()){

            $data = Transportadora::query();

            return  DataTables::eloquent($data)
            ->addColumn('action', function($data){

                $rota = "'" .  route('admin.delete.transportadora') . "'";
                $btn = '<a href="#" class="btn btn-primary alter-min" data-id="'.$data->id.'"><i
                class="tim-icons icon-pencil"></i></a>

                <button type="button" class="btn btn-primary red-min" id="excluir-trans"
                name="excluir-transportadora"
                 onclick="excluir('.$data->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
