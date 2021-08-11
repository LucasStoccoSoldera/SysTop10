<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegister extends Controller
{

    use RegistersUsers;

    /**
     * @param  array  $data
     * @return \App\Models\Usuario
     */
    protected function createUser(Request $request)
    {
        $dataForm = $request->all();
        $dataForm['statusUser'] = (!isset($dataForm['statusUser']))? 0 : 1;

        $validator = Validator::make($request->all(),[
            'nomeUser' => ['required', 'string'],
            'usuarioUser' => ['required', 'email'],
            'senhaUser' => ['required', 'string', 'confirmed'],
            'celularUser' => ['required', 'string'],
            'cpfUser' => ['required', 'string'],
            'cargoUser' => ['required', 'string'],
        ],
        [
            'nomeUser.required' => 'Nome obrigatório.',
            'usuarioUser.required' => 'E-mail obrigatório.',
            'usuarioUser.unique' => 'O E-mail informado ja está em uso.',
            'usuarioUser.email' => 'O E-mail informado é inválido.',
            'senhaUser.required' => 'Senha obrigatória.',
            'senhaUser.confirmed' => 'A confirmação da senha não corresponde.',
            'celularUser.required' => 'Celular obrigatório.',
            'celularUser.celular' => 'Celular inválido.',
            'cpfUser.required' => 'CPF obrigatório.',
            'cpfUser.cpf' => 'CPF inválido.',
            'cargoUser.required' => 'Cargo obrigatório.',
       ]);




        if($validator->fails()){
            return response()->json(['status' =>0, 'error' => $validator->errors()]);
        }
        $Usuario = new Usuario;
        $Usuario->usu_nome_completo = $request->nomeUser;
        $Usuario->usu_usuario = $request->usuarioUser;
        $Usuario->usu_senha = Hash::make($request->senhaUser);
        $Usuario->usu_celular = $request->celularUser->preg_replace('/[^0-9]/', '');
        $Usuario->usu_cpf = $request->cpfUser->preg_replace('/[^0-9]/', '');
        $Usuario->car_id = $request->cargoUser;
        $Usuario->usu_status = $request->$dataForm['statusUser'];
        $Usuario->save();

            if($Usuario){
                return response()->json(['status' => 1, 'msg' => 'Usuário cadastrado com sucesso!']);
            }
        }
}


