<?php

namespace App\Http\Controllers\Delete;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoDelete extends Controller
{
    public function deleteCargo(Request $request)
    {
        $data=Cargo::find($request->id);

        $descricao = $data->car_descricao;

        $data->delete();
        $msgExcluir = "O cargo $descricao foi excluída com sucesso!";
        return redirect()->back()->with($msgExcluir);
    }
}
