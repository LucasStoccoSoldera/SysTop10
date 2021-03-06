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
                $btn = '<a class="btn btn-primary alter-min" data-id="'.$data->id.'"><i
                class="tim-icons icon-pencil" onclick="editTransportadora('.$data->id.');"></i></a>
                ';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
