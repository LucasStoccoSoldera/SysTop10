<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Pacote;
use Illuminate\Support\Facades\DB;

class PacoteDelete extends Controller
{
    public function deletePacote(Request $request)
    {
        $data=Pacote::find($request->id);
        $verifica_produto =DB::select("select * from produto where pac_id = $data->id");
        $verifica_logistica =DB::select("select * from logistica where pac_id = $data->id");

        if(isset($verifica_produto) || isset($verifica_logistica)) {
            return response()->json(['status' => 0, 'msg' => 'Existe um produto com esse pacote!']);
        }

        $descricao = $data->pac_descricao;

        $data->delete();
        $msgExcluir = "O pacote $descricao foi excluído com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }
}
