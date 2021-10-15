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

                $btn = '<a class="btn btn-primary alter" data-id="'.$data6->id.'"><i
                class="tim-icons icon-pencil" onclick="edit.editCor('.$data6->id.');"></i></a>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
