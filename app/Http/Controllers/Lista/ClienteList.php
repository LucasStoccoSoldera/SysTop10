<?php

namespace App\Http\Controllers\Lista;

use App\Http\Controllers\Controller;
use App\Models\Cliente;

class ClienteList extends Controller
{

    public function listCliente(){

        $dado1 = Cliente::count();
        $dado2 = Cliente::count();
        $dado3 = Cliente::count();

        $data = Cliente::limit(25)->get();


        return  response()->json(['clientes' => $data]);
    }
}
