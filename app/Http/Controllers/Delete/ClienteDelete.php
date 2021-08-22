<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\{Cliente};

class ClienteDelete extends Controller
{
    public function deleteCliente(Request $request)
    {
        $data=Cliente::find($request->id);

        $nome = $data->cli_nome;

        $data->delete();
        $msgExcluir = "O cliente $nome foi excluído com sucesso!";
        return response()->json(['msg' => $msgExcluir]);
    }
}

