<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialBaseRequest;
use App\Models\Material_Base;
use Illuminate\Support\Facades\Validator;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class MaterialBaseRegister extends Controller
{

    /**
     * @return \App\Models\Material_Base
     */
    protected function createMaterialBase(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'descricaoMaterial' => ['required', 'string'],
        ],
        [
            'descricaoMaterial.required' => 'Material obrigatório.',
       ]);

        if($validator->fails()){
            return response()->json(['status' =>0, 'error' => $validator->errors()]);
        }
        $Material_Base = new Material_Base;
        $Material_Base->mat_descricao = $request->descricaoMaterial;
        $Material_Base->save();

            if($Material_Base){
                return response()->json(['status' => 1, 'msg' => 'Material cadastrado com sucesso!']);
            }
        }
}

