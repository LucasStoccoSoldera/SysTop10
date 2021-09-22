<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use App\Transformers\ClienteTransformer;

class ClienteList extends Controller
{

    public function listCliente(Request $request){

        $dado1 = Cliente::count();
        $dado2 = Cliente::count();
        $dado3 = Cliente::count();

        if($request->ajax()){

            $data = Cliente::select('cli_nome', 'cli_cpf_cnpj', 'cli_celular', 'cli_cidade',
            DB::raw("DATE_FORMAT(cliente.created_at, '%d/%m/%Y %H:%i') as created_at"));

            return  DataTables::eloquent($data)
            ->addColumn('action', function($data){

                $rota = "`{{route('admin.delete.cliente')}}`";
                $btn = '<a href="#" class="btn btn-primary alter" data-id="'.$data->id.'"><i
                class="tim-icons icon-pencil"></i></a>

                <button type="button" class="btn btn-primary red" id="excluir-cli"
                name="excluir-cliente"
                 onclick="excluir('.$data->id.', ' . $rota . ');"><i
                class="tim-icons icon-simple-remove"></i></button>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
