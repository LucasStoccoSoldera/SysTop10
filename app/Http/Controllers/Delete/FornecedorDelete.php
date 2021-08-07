<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Fornecedores;

class FornecedorDelete extends Controller
{
    public function deleteFornecedor(Request $request)
    {
        $data=Fornecedores::find($request->id);

        $nome = $data->for_nome;

        $data->delete();
        $msgExcluir = "O fornecedor $nome foi excluído com sucesso!";
        return redirect()->back()->with($msgExcluir);
    }
}
