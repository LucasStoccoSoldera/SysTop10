<?php

namespace App\Http\Controllers\Lista;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\TipoProduto;
use App\Transformers\TipoProdutoTransformer;

class TipoProdutoList extends Controller
{
    public function listTipoProduto(Request $request){

        if($request->ajax()){

            $data2 = TipoProduto::query();

            return DataTables::eloquent($data2)
            ->addColumn('action', function($data2){

            $rota = "'" .  route('admin.delete.tipoproduto') . "'";
            $btn = '<a class="btn btn-primary alter" data-id="'.$data2->id.'"><i
            class="tim-icons icon-pencil" onclick="edit.editTipoProduto('.$data2->id.');"></i></a>

            <button type="button" class="btn btn-primary red" id="excluir-tpp"
            name="excluir-tipoproduto"
             onclick="excluir('.$data2->id.', ' . $rota . ');"><i
            class="tim-icons icon-simple-remove"></i></button>';

            return $btn;
        })

        ->rawColumns(['action'])
        ->toJson();
        }
    }
}
