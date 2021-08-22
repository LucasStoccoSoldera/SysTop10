<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Cor;

class CoresDelete extends Controller
{
    public function deleteCor(Request $request)
    {
        $data=Cor::find($request->id);

        $descricao = $data->cor_descricao;

        $data->delete();
        $msgExcluir = "A cor $descricao foi excluída com sucesso!";
        return response()->json(['msg' => $msgExcluir]);
    }
}
