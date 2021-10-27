<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\{Cliente};
use Illuminate\Support\Facades\DB;

class ClienteDelete extends Controller
{
    public function deleteCliente(Request $request)
    {
        $data=Cliente::find($request->id);
        $verifica_venda =DB::select("select * from vendas where cli_id = $data->id and ven_status = 'Em Aberto'");

        if(isset($verifica_venda)) {
            return response()->json(['status' => 0, 'msg' => 'Existe uma venda em aberto para esse cliente!']);
        }   

        $nome = $data->cli_nome;

        $data->delete();
        $msgExcluir = "O cliente $nome foi excluído com sucesso!";
        return response()->json(['msg' => $msgExcluir]);
    }
}

