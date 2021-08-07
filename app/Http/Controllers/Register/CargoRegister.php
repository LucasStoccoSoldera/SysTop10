<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\Cargo;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class CargoRegister extends Controller
{
    protected function createCargo(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'descricaoCargo' => ['required', 'string'],
        ],
        [
            'descricaoCargo.required' => 'Cargo obrigatório.',
       ]);

        if($validator->fails()){
            return response()->json(['status' =>0, 'error' => $validator->errors()]);
        }
        $Cargo = new Cargo;
        $Cargo->car_descricao = $request->descricaoCargo;
        $Cargo->save();

            if($Cargo){
                return response()->json(['status' => 1, 'msg' => 'Cargo cadastrado com sucesso!']);
            }
        }
}


