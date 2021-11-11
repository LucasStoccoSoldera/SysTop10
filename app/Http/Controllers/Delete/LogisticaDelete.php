<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Logistica;
use App\Models\Produto;
use App\Models\Transportadora;

class LogisticaDelete extends Controller
{
    public function deleteLogistica(Request $request)
    {
        $data=Logistica::find($request->id);
        $verifica =Produto::where('log_id', '=', $data->id )->count();

        if($verifica > 0) {
            return response()->json(['status' => 0, 'msg' => 'Existe um produto com essa logística!']);
        }

        $data->delete();
        $msgExcluir = "A relação logística $request->id foi excluído com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }

    public function deleteTransportadora(Request $request)
    {
        $data=Transportadora::find($request->id);

        $data->delete();
        $msgExcluir = "A transportadora $request->id foi excluída com sucesso!";
        return response()->json(['status' => 1, 'msg' => $msgExcluir]);
    }
}
