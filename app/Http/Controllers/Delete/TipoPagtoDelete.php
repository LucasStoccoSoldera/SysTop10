<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\TipoPagto;

class TipoPagtoDelete extends Controller
{
    public function deleteTipoPagto(Request $request)
    {
        $data=TipoPagto::find($request->id);

        $descricao = $data->tpg_descricao;

        $data->delete();
        $msgExcluir = "O tipo de pagamento $descricao foi excluído com sucesso!";
        return response()->json(['msg' => $msgExcluir]);
    }
}
