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

            DataTables::eloquent($data2)
            ->addColumn('action', function($data2){

            $btn = '<a href="#" class="btn btn-primary" id="alter"><i
            class="tim-icons icon-pencil"></i></a>
            
            <button class="btn btn-primary red" id="excluir-cli"
            name="excluir-cliente" data-id=" '.$data2->id.' " data-rota=" '. route('admin.delete.tipoproduto') .'"
            style="padding: 11px 25px;"><i
            class="tim-icons icon-simple-remove"></i></button>';

            return $btn;
        })

        ->rawColumns(['action'])
        ->toJson();
        }
    }
}
