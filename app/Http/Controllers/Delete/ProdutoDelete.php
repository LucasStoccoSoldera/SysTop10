<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\CorProduto;
use App\Models\DimensaoProduto;

class ProdutoDelete extends Controller
{
    public function deleteProduto(Request $request)
    {
        $data=Produto::find($request->id);
        $verifica =CorProduto::where('pro_id', '=', $data->id )->count();

        $verifica_2 =DimensaoProduto::where('pro_id', '=', $data->id )->count();

        if($verifica > 0 || $verifica_2 > 0) {
            return response()->json(['status' => 0, 'msg' => 'Existem vínculos com esse produto!']);
        }

        $descricao = $data->pro_descricao;

        $data->delete();
        $msgExcluir = "O produto $descricao foi excluído com sucesso!"; 
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }
}
