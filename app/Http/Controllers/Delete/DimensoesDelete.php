<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Dimensao;

class DimensoesDelete extends Controller
{
    public function deleteDimensao(Request $request)
    {
        $data=Dimensao::find($request->id);

        $descricao = $data->dim_descricao;

        $data->delete();
        $msgExcluir = "A dimensão $descricao foi excluída com sucesso!";
        return response()->json(['msg' => $msgExcluir]);
    }
}
