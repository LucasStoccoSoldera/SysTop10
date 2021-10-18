<?php

namespace App\Http\Controllers\Update;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserUpdate extends Controller
{

    protected function editUser($id)
    {
        $object = Usuario::find($id);
        return response()->json($object);
    }

    use RegistersUsers;

    /**
     * @param  array  $data
     * @return \App\Models\Usuario
     */
    protected function updateUser(Request $request)
    {
        $dataForm = $request->all();

        $validator = Validator::make($request->all(),[
            'nomeUser' => ['required', 'string'],
            'usu_usuario' => ['required', 'email','unique:usuario'],
            'senhaUser' => ['required', 'string', 'confirmed'],
            'celularUser' => ['required', 'celular_com_ddd'],
            'cpfUser' => ['required', 'string'],
            'cargoUser' => ['required', 'string'],
        ],
        [
            'nomeUser.required' => 'Nome obrigatório.',
            'usu_usuario.required' => 'E-mail obrigatório.',
            'usu_usuario.unique' => 'O E-mail informado ja está em uso.',
            'usu_usuario.email' => 'O E-mail informado é inválido.',
            'senhaUser.required' => 'Senha obrigatória.',
            'senhaUser.confirmed' => 'A confirmação não corresponde.',
            'celularUser.required' => 'Celular obrigatório.',
            'celularUser.celular_com_ddd' => 'Celular inválido.',
            'cpfUser.required' => 'CPF obrigatório.',
            'cpfUser.cpf' => 'CPF inválido.',
            'cargoUser.required' => 'Cargo obrigatório.',
       ]);

        if($validator->fails()){
            return response()->json(['status' =>0, 'error' => $validator->errors()]);
        }
        $Usuario = new Usuario;
        $Usuario->usu_nome_completo = $request->nomeUser;
        $Usuario->usu_usuario = $request->usu_usuario;
        $Usuario->usu_senha = Hash::make($request->senhaUser);
        $Usuario->usu_celular = $request->celularUser;
        $Usuario->usu_cpf = $request->cpfUser;
        $Usuario->car_id = $request->cargoUser;
        $Usuario->usu_status = $request->statusUser;
        $Usuario->save();

            if($Usuario){
                return response()->json(['status' => 1, 'msg' => 'Usuário cadastrado com sucesso!']);
            }
        }
}


