<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
    //    $admin = '';
        $this->middleware('guest');
    //    $this->admin = $admin;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'cli_nome' => ['required', 'string', 'max:255'],
            'cli_usuario' => ['required', 'string', 'email', 'max:255', 'unique:tb_cliente'],
            'cli_senha' => ['required', 'string', 'min:5', 'confirmed'],
            'cli_cpf' => ['required', 'string', 'max:14', 'confirmed'],
            'cli_cnpj' => ['required', 'string', 'max:14', 'confirmed'],
            'cli_telefone' => ['required', 'string', 'max:10', 'confirmed'],
            'cli_celular' => ['required', 'string', 'max:11', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Cliente
     */
    protected function create(array $data)
    {
        return Cliente::create([
            'cli_nome' => $data['cli_nome'],
            'cli_usuario' => $data['cli_usuario'],
            'cli_senha' => Hash::make($data['cli_senha']),
            'cli_cpf' => $data['cli_cpf'],
            'cli_telefone' => $data['cli_telefone'],
        ]);

    }
}


