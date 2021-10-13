<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Fornecedores;
use Illuminate\Support\Facades\DB;

class FornecedorDelete extends Controller
{
    public function deleteFornecedor(Request $request)
    {
        $data=Fornecedores::find($request->id);
        $verifica_compra =DB::select("select * from compras where for_id = $data->id and com_data_pagto = null");

        if(isset($verifica_compra)) {
            return response()->json(['status' => 0, 'msg' => 'Existe uma compra em aberto para esse fornecedor!']);
        }

        $nome = $data->for_nome;

        $data->delete();
        $msgExcluir = "O fornecedor $nome foi excluído com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }
}
