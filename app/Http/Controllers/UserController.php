<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Privilegio;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class UserController extends Controller
{
    public function Usuario(){

        $ano = date("Y");
        $mes = date("m");
        $dia = date("d");
        $hora = date("H");
        $minuto = date("i");
        $segundo = date("s");
        $now = date("Y-m-d H:i:s");
        $ontem = Carbon::now()->subDay();
        $mes_passado = Carbon::now()->subMonth();
        $ano_passado = Carbon::now()->subYear();


        $todos = Usuario::all()->count();

        $dado1 = Usuario::count();
        $dado2 = Usuario::where('car_id', 1)->count();
        $dado3 = $todos - $dado2;

        $data = Usuario::all();
        $data2 = Cargo::all();
        $data3 = Privilegio::all();


   //   $data = DB::select('select
   //   usu_id, usu_nome_completo, car_descricao, usu_data_cadastro
   //   from usuario
   //   inner join cargo
   //   on usuario.car_id = cargo.car_id;');

        return view('dashboard.usuarios', [
            'dado1' => $dado1,
            'dado2' => $dado2,
            'dado3' => $dado3,

            'usuarios' => $data,
            'cargos' => $data2,
            'privilegios' => $data3
        ]);
    }
}
