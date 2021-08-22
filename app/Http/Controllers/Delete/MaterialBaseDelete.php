<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Material_Base;

class MaterialBaseDelete extends Controller
{
    public function deleteMaterialBase(Request $request)
    {
        $data=Material_Base::find($request->id);

        $descricao = $data->mat_descricao;

        $data->delete();
        $msgExcluir = "O material base $descricao foi excluído com sucesso!";
        return response()->json(['msg' => $msgExcluir]);
    }
}
