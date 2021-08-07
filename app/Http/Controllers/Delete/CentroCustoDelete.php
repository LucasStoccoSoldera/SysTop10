<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Centro_Custo};

class CentroCustoDelete extends Controller
{
    public function deleteCentroCusto(Request $request)
    {
        $data=Centro_Custo::find($request->id);

        $descricao = $data->cc_descricao;

        $data->delete();
        $msgExcluir = "O centro de custo $descricao foi excluído com sucesso!";
        return redirect()->back()->with($msgExcluir);
    }
}
