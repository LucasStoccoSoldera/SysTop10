<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Models\Privilegio;
use App\Models\Usuario;

class UserList extends Controller
{
    public function listUser(){

        $dado1 = Usuario::count();
        $dado2 = Usuario::where('car_id', '1')->count();
        $dado3 = Usuario::where('car_id', '2' && '3')->count();

        $data = Usuario::all();
        $data2 = Cargo::all();
        $data3 = Privilegio::all();

   return  response()->json(['usuarios' => $data, 'cargos' => $data2, 'privilegios' => $data3]);
    }
}
