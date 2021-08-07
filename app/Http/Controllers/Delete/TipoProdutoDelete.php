<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\TipoProduto;

class TipoProdutoDelete extends Controller
{
    public function deleteTipoProduto(Request $request)
    {
        $data=TipoProduto::find($request->id);

        $descricao = $data->tpp_descricao;

        $data->delete();
        $msgExcluir = "O tipo de produto $descricao foi excluído com sucesso!";
        return redirect()->back()->with($msgExcluir);
    }
}
