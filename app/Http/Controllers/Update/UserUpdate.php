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
            'nomeUserUp' => ['required', 'string'],
            'usu_usuarioUp' => ['required', 'email','unique:usuario'],
            'senhaUserUp' => ['required', 'string', 'confirmed'],
            'celularUserUp' => ['required', 'celular_com_ddd'],
            'cpfUserUp' => ['required', 'string'],
            'cargoUserUp' => ['required', 'string'],
        ],
        [
            'nomeUserUp.required' => 'Nome obrigatório.',
            'usu_usuarioUp.required' => 'E-mail obrigatório.',
            'usu_usuarioUp.unique' => 'O E-mail informado ja está em uso.',
            'usu_usuarioUp.email' => 'O E-mail informado é inválido.',
            'senhaUserUp.required' => 'Senha obrigatória.',
            'senhaUserUp.confirmed' => 'A confirmação não corresponde.',
            'celularUserUp.required' => 'Celular obrigatório.',
            'celularUserUp.celular_com_ddd' => 'Celular inválido.',
            'cpfUserUp.required' => 'CPF obrigatório.',
            'cpfUserUp.cpf' => 'CPF inválido.',
            'cargoUserUp.required' => 'Cargo obrigatório.',
       ]);

        if($validator->fails()){
            return response()->json(['status' =>0, 'error' => $validator->errors()]);
        }
        $Usuario = Usuario::find($request->idUsu);
        $Usuario->usu_nome_completo = $request->nomeUserUp;
        $Usuario->usu_usuario = $request->usu_usuarioUp;
        $Usuario->usu_senha = Hash::make($request->senhaUserUp);
        $Usuario->usu_celular = $request->celularUserUp;
        $Usuario->usu_cpf = $request->cpfUserUp;
        $Usuario->car_id = $request->cargoUserUp;
        $Usuario->usu_status = $request->statusUserUp;
        $Usuario->save();

            if($Usuario){
                return response()->json(['status' => 1, 'msg' => 'Usuário atualizado com sucesso!']);
            }
        }
}


