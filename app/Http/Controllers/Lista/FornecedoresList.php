<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fornecedores;
use App\Models\Produto;
use App\Transformers\FornecedoresTransformer;

class FornecedoresList extends Controller
{
    public function listFornecedores(Request $request){

        $dado1 = Fornecedores::count();
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Fornecedores::query();

        if($request->ajax()){

            $data = Fornecedores::query();

            return  DataTables::eloquent($data)
            ->addColumn('action', function($data){

                $rota = "'" . route('admin.delete.fornecedor') . "'";
                $btn = '<a class="btn btn-primary alter" data-id="'.$data->id.'"><i
                class="tim-icons icon-pencil" onclick="edit.editFornecedor('.$data->id.');"></i></a>

                <button type="button" class="btn btn-primary red" id="excluir-for"
                name="excluir-fornecedor"
                 onclick="excluir('.$data->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();;
        }
    }
}
