<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Material_Base;
use App\Transformers\MaterialTransformer;

class MaterialList extends Controller
{
    public function listMaterial(Request $request){

        if($request->ajax()){

            $data3 = Material_Base::query();

            return DataTables::eloquent($data3)
            ->addColumn('action', function($data3){

                $btn = '<a href="#" class="btn btn-primary alter" data-id="'.$data3->id.'"><i
                class="tim-icons icon-pencil"></i></a>

                <button type="button" class="btn btn-primary red" id="excluir-mat"
                name="excluir-material" data-id="'.$data3->id.'" data-rota="'. route('admin.delete.material') .'"
                onclick="excluir();"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
