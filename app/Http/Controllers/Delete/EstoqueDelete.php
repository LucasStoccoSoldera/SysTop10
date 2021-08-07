<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Estoque;

class EstoqueDelete extends Controller
{
    public function deleteEstoque(Request $request)
    {
        $data=Estoque::find($request->id);

        $data->delete();
        $msgExcluir = "A entrada $request->id foi excluída com sucesso!";
        return redirect()->back()->with($msgExcluir);
    }
}
