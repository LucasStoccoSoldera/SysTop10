<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Dimensao;
use App\Transformers\DimensaoTransformer;

class DimensaoList extends Controller
{
    public function listDimensao(Request $request){

        if($request->ajax()){
            $data5 = Dimensao::query();

            return DataTables::eloquent($data5)
            ->addColumn('action', function($data5){

                $rota = "'" .  route('admin.delete.dimensao') . "'";
                $btn = '<a href="#" class="btn btn-primary alter" data-id="'.$data5->id.'"><i
                class="tim-icons icon-pencil"></i></a>

                <button type="button" class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente"
                 onclick="excluir('.$data5->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })

            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
