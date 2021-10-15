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

                $rota = "'" . route('admin.delete.material') . "'";
                $btn = '<a class="btn btn-primary alter" data-id="'.$data3->id.'"><i
                class="tim-icons icon-pencil" onclick="edit.editMaterial('.$data3->id.');"></i></a>

                <button type="button" class="btn btn-primary red" id="excluir-mat"
                name="excluir-material"
                 onclick="excluir('.$data3->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
