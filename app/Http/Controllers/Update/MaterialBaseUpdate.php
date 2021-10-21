<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialBaseRequest;
use App\Models\Material_Base;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class MaterialBaseUpdate extends Controller
{

    protected function editMaterialBase($id)
    {
        $object = Material_Base::find($id);
        return response()->json($object);
    }

    /**
     * @return \App\Models\Material_Base
     */
    protected function updateMaterialBase(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'NomeMaterialUp' => ['required', 'string'],
            ],
            [
                'NomeMaterialUp.required' => 'Material obrigatório.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()]);
        }
        $Material_Base = new Material_Base;
        $Material_Base->mat_descricao = $request->NomeMaterialUp;
        $Material_Base->save();

        if ($Material_Base) {
            return response()->json(['status' => 1, 'msg' => 'Material atualizado com sucesso!']);
        }
    }
}
