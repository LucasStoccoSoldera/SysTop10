<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class UserDelete extends Controller
{
    public function deleteUser(Request $request)
    {

        $data=Usuario::find($request->id);

        if(Auth::user() == $data->usu_usuario){
            return response()->json(['msg' => 'Impossível excluir, usuário em uso!']);
        } else{

        $nome = $data->usu_nome_completo;

        $data->delete();
        $msgExcluir = "O usuário $nome foi excluído com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
        }
    }
}
