<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Privilegio;
use App\Models\Usuario;

class UserController extends Controller
{
    public function Usuario(){

        $col01 = 'ID';
        $col02 = 'Nome Completo';
        $col03 = 'Cargo';
        $col04 = 'Data Cadastro';
        $col05 = 'Ações';

        $dado1 = Usuario::count();
        $dado2 = Usuario::where('car_id', '1')->count();
        $dado3 = Usuario::where('car_id', '2' && '3')->count();

        $data = Usuario::all();
        $data2 = Cargo::all();
        $data3 = Privilegio::all();


   //   $data = DB::select('select
   //   usu_id, usu_nome_completo, car_descricao, usu_data_cadastro
   //   from usuario
   //   inner join cargo
   //   on usuario.car_id = cargo.car_id;');

        return view('dashboard.usuarios', [
            'col01' => $col01,
            'col02' => $col02,
            'col03' => $col03,
            'col04' => $col04,
            'col05' => $col05,

            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,

            'usuarios' => $data,
            'cargos' => $data2,
            'privilegios' => $data3
        ]);
    }
}
