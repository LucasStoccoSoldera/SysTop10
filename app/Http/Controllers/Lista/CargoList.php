<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Transformers\CargoTransformer;

class CargoList extends Controller
{
    public function listCargo(Request $request){

        if($request->ajax()){

                $data2 = Cargo::query();

              return  DataTables::eloquent($data2)
                ->addColumn('action', function($data2){

                $btn = '<a href="#" class="btn btn-primary alter" data-id="'.$data2->id.'"><i
                class="tim-icons icon-pencil"></i></a>

                <button type="button" class="btn btn-primary red" id="excluir-car"
                name="excluir-cargo" data-id="'.$data2->id.'" data-rota="'. route('admin.delete.cargo') .'"
               ><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
                })
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}

