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

                $rota = "'" . route('admin.delete.cor') . "'";
                $btn = '<a href="#" class="btn btn-primary alter" data-id="'.$data6->id.'"><i
                class="tim-icons icon-pencil"></i></a>

               <button type="button" class="btn btn-primary red" id="excluir-cor"
                name="excluir-cor"
                 onclick="excluir('.$data6->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
