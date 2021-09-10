<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Cor;
use App\Transformers\CorTransformer;

class CorList extends Controller
{
    public function listCor(Request $request){

        if($request->ajax()){

            $data6 = Cor::query();

            return DataTables::eloquent($data6)
            ->addColumn('action', function($data6){

                $btn = '<a href="#" class="btn btn-primary" id="alter" data-id=" '.$data6->id.' "><i
                class="tim-icons icon-pencil"></i></a>

               <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data6->id.' " data-rota=" '. route('admin.delete.cor') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
