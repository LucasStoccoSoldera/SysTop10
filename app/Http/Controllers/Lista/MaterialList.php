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

            DataTables::eloquent($data3)
            ->setTransformer(new MaterialTransformer)
            ->addColumn('action', function($data3){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data3->id.' " data-rota=" '. route('admin.delete.material') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
