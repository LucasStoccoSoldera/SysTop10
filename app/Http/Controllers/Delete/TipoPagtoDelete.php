<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\TipoProduto;

class TipoPagtoDelete extends Controller
{
    public function deleteTipoPagto(Request $request)
    {
        $data=TipoProduto::find($request->id);

        $descricao = $data->tpg_descricao;

        $data->delete();
        $msgExcluir = "O tipo de pagamento $descricao foi excluído com sucesso!";
        return response()->json(['msg' => $msgExcluir]);
    }
}
