<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoDelete extends Controller
{
    public function deleteProduto(Request $request)
    {
        $data=Produto::find($request->id);

        $descricao = $data->pro_descricao;

        $data->delete();
        $msgExcluir = "O produto $descricao foi excluído com sucesso!";
        return response()->json(['msg' => $msgExcluir]);
    }
}
