<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Material_Base;
use Illuminate\Support\Facades\DB;

class MaterialBaseDelete extends Controller
{
    public function deleteMaterialBase(Request $request)
    {
        $data=Material_Base::find($request->id);
        $verifica_produto =DB::select("select * from produto where mat_id = $data->id");

        if(isset($verifica_produto)) {
            return response()->json(['status' => 0, 'msg' => 'Existe um produto com esse material!']);
        }

        $descricao = $data->mat_descricao;

        $data->delete();
        $msgExcluir = "O material base $descricao foi excluído com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }
}
