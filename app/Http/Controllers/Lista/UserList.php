<?php

namespace App\Http\Controllers\Lista;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Privilegio;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use App\Transformers\UserTransformer;
use App\Transformers\CargoTransformer;

class UserList extends Controller
{
    public function listUser(Request $request){

        $dado1 = Usuario::count();
        $dado2 = Usuario::where('car_id', '1')->count();
        $dado3 = Usuario::where('car_id', '2' && '3')->count();

        if($request->ajax()){

            $data = Usuario::select('usuario.id', 'usu_nome_completo', 'car_descricao', 'usu_celular',
            DB::raw("DATE_FORMAT(usuario.usu_data_cadastro, '%d/%m/%Y %H:%i') as usu_data_cadastro"))
            ->join('cargo', 'usuario.car_id', '=', 'cargo.id');

            return  DataTables::eloquent($data)
            ->setTransformer(new UserTransformer)
            ->rawColumns(['action'])
            ->toJson();
        }
    }
}
