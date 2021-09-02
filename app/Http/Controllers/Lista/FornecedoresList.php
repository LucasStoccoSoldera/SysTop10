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

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>
                
                <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data->id.' " data-rota=" '. route('admin.delete.fornecedor') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();;
        }
    }
}
