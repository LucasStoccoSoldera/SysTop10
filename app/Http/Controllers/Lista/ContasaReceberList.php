<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contas_a_Receber;

class ContasaReceberList extends Controller
{
    public function listContasaReceber(Request $request){


        $dado1 = 'teste';
        $dado2 = 'teste';
        $dado3 = 'teste';

        $data = Contas_a_Receber::all();

        if($request->ajax()){

            $data = Contas_a_Receber::all();
            return  DataTables::of ($data)->addColumn('Ações', function($data){

                $btn = '<a href="#" class="btn btn-primary" id="alter"><i
                class="tim-icons icon-pencil"></i></a>';
                $btn = ' <button class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente" data-id=" '.$data->id.' " data-rota=" '. route('admin.delete.receber') .'"
                style="padding: 11px 25px;"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
