<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use App\Models\Compras;
use App\Models\Compras_Detalhe;
use Illuminate\Http\Request;
use App\Models\Contas_a_Pagar;
use App\Models\Parcelas;
use App\Models\Estoque;
use App\Models\Notificacao;

class ContasDelete extends Controller
{
    public function deleteConta(Request $request)
    {
        $data=Contas_a_Pagar::find($request->id);

        $descricao = $data->con_descricao;

        $data->delete();
        $msgExcluir = "A conta $descricao foi excluído com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }

    public function deleteCompra(Request $request)
    {
        $data=Compras::find($request->id);

        $data->delete();
        $msgExcluir = "Compra excluída com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }

    public function deleteItemCompra(Request $request)
    {
        $data=Compras_Detalhe::find($request->id);

        $Estoque = new Estoque();
        $Estoque->pro_id = $data->IDProduto;
        $Estoque->dim_id = $data->IDDimensao;
        $Estoque->cor_id =  $data->IDCor;
        $Estoque->est_qtde = $request->qtdeItemVenda * -1;
        $Estoque->save();
        $data->delete();
        return response()->json();
    }
}
