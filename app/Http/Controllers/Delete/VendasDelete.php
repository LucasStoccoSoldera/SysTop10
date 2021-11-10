<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Venda_Detalhe;
use App\Models\Estoque;
use App\Models\Parcelas;
use App\Models\Notificacao;

class VendasDelete extends Controller
{
    public function deleteVenda(Request $request)
    {
        $data=Venda::find($request->id);

        $descricao = $data->ven_id;

        $data->delete();
        $msgExcluir = "A venda $descricao foi excluída com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }

    public function deleteItemVenda(Request $request)
    {
        $data=Venda_Detalhe::find($request->id);

        $Estoque = new Estoque();
        $Estoque->pro_id = $data->IDProduto;
        $Estoque->dim_id = $data->IDDimensao;
        $Estoque->cor_id =  $data->IDCor;
        $Estoque->est_qtde = $request->qtdeItemVenda;
        $Estoque->save();
        $data->delete();

        $msgExcluir = "O item $data->id foi excluído com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }
}
