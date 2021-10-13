<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\TipoProduto;
use Illuminate\Support\Facades\DB;

class TipoProdutoDelete extends Controller
{
    public function deleteTipoProduto(Request $request)
    {
        $data=TipoProduto::find($request->id);
        $verifica_produto =DB::select("select * from produto where tpp_id = $data->id");

        if(isset($verifica_produto)) {
            return response()->json(['status' => 0, 'msg' => 'Existe um produto com esse tipo!']);
        }

        $descricao = $data->tpp_descricao;

        $data->delete();
        $msgExcluir = "O tipo de produto $descricao foi excluído com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }
}
