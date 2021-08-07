<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Pacote;

class PacoteDelete extends Controller
{
    public function deletePacote(Request $request)
    {
        $data=Pacote::find($request->id);

        $descricao = $data->pac_descricao;

        $data->delete();
        $msgExcluir = "O pacote $descricao foi excluído com sucesso!";
        return redirect()->back()->with($msgExcluir);
    }
}
