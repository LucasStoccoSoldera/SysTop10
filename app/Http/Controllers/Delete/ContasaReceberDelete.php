<?php
namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Contas_a_Receber;
use App\Models\Parcelas;
use App\Models\Notificacao;

class ContasaReceberDelete extends Controller
{
    public function deleteReceber(Request $request)
    {
        $data=Contas_a_Receber::find($request->id);

        $descricao = $data->rec_descricao;

        $data->delete();
        $msgExcluir = "O recebimento $descricao foi excluído com sucesso!";
        return response()->json(['status' => 0, 'msg' => $msgExcluir]);
    }
}

