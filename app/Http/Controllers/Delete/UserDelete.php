<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UserDelete extends Controller
{
    public function deleteUser(Request $request)
    {
        $data=Usuario::find($request->id);

        $nome = $data->usu_nome_completo;

        $data->delete();
        $msgExcluir = "O usuário $nome foi excluído com sucesso!";
        return response()->json(['msg' => $msgExcluir]);
    }
}
